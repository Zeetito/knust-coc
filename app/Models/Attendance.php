<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    use HasFactory;

    // The type of service should be added to the table so that we could query later, how many times an
    // individual has attended a particular servie, say evening service

    protected $fillable = [
        'semester_program_id',
        'semester_id',

    ];

    // public function members(): hasMany{
    //     return $this->hasMany(User::class,'attendance_users','attendance_id','user_id')
    //     ->withPivot('user_id')
    //     ;
    // }

    // RELATIONSHIPS



    // Members function to query for users who're currently members and present
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
            ->where('is_member', 1)

            ->withPivot('person_id', 'checked_by');
    }

    // Members function to query for users who're currently members and present
    public function members()
    {
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('is_user', 1)
                    ->where('is_present', 1)
                    ->withPivot('person_id', 'checked_by');
    }

    // Find the related Semester
    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    // Retrieve Attendance users instances
    public function attendance_users(){
        return $this->hasMany(AttendanceUser::class);
    }



    // Get Semester Program
    public function semesterProgram(): BelongsTo
    {
        return $this->belongsTo(SemesterProgram::class);
    }

    public function user_marked_by($user)
    {
        return User::find($user);
    }

    // Getting All Males(Members) present for a particular attendance session
    public function males_members_present()
    {
        return User::where('is_member', 1)
            ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
            ->where('attendance_users.attendance_id', $this->id)
            ->where('attendance_users.is_present',1)
            ->where('users.gender', 'm')
            ->where('attendance_users.is_user', 1)
            ->get();
    }

    // MEMBERS
    // Getting Females(Members) present for a particular attendance session
    public function females_members_present()
    {
        return User::where('is_member', 1)
            ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
            ->where('attendance_users.attendance_id', $this->id)
            ->where('attendance_users.is_present',1)
            ->where('users.gender', 'f')
            ->where('attendance_users.is_user', 1)
            ->get();
    }

    // VISITORS - GUESTS
    // Getting All (Guest) present for a particular attendance session
    public function guests_present()
    {
        return Guest::join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                        ->where('attendance_users.attendance_id', $this->id)
                        ->where('attendance_users.is_user', 0)
                        ->get();
    }

    // Getting Males (Guest) present for a particular attendance session
    public function males_guests_present()
    {
        return Guest::
                // where('is_member',1)
                join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                    ->where('attendance_users.attendance_id', $this->id)
                    ->where('guests.gender', 'm')
                    ->where('attendance_users.is_user', 0)
                    ->get();
    }

    // Getting females (Guest) present for a particular attendance session
    public function females_guests_present()
    {
        return Guest::
                // where('is_member',1)
                join('attendance_users', 'guests.id', '=', 'attendance_users.person_id')
                    ->where('attendance_users.attendance_id', $this->id)
                    ->where('guests.gender', 'f')
                    ->where('attendance_users.is_user', 0)
                    ->get();
    }

    // VISITORS - USERS
    // Getting All Users who visited (not Members)
    public function users_visitors_present()
    {
        return User::where('is_member', 0)
            ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
            ->where('attendance_users.attendance_id', $this->id)
            ->where('attendance_users.is_user', 1)
            ->get();
    }

    // Getting Male Users who visited (not Members)
    public function users_male_visitors_present()
    {
        return User::where('is_member', 0)
            ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
            ->where('attendance_users.attendance_id', $this->id)
            ->where('users.gender', 'm')
            ->where('attendance_users.is_user', 1)
            ->get();
    }

    // Getting Female Users who visited (not Members)
    public function users_female_visitors_present()
    {
        return User::where('is_member', 0)
            ->join('attendance_users', 'users.id', '=', 'attendance_users.person_id')
            ->where('attendance_users.attendance_id', $this->id)
            ->where('users.gender', 'f')
            ->where('attendance_users.is_user', 1)
            ->where('users.is_member', 0)
            ->get();
    }

    // Get the total visitors count
    public function visitors_count()
    {
        return $this->males_guests_present()->count() + $this->females_guests_present()->count() + $this->users_male_visitors_present()->count() + $this->users_female_visitors_present()->count();
    }

    // Get the total count of individuals for a particular attendance session
    public function total_count()
    {
        return $this->visitors_count() + $this->members()->count();
    }

    // Search Attendance
    public static function search_attendance(Semester $semester, Request $request){
        // NB... the names of the attendance on the front end is the name of the corresponding
        // semester program
        $string = $request->input('str');
        $str = '%'.$string.'%';

        if (! empty($string)) {

        $semester_programs  =  $semester->semester_programs()->where('name','like',"$str")->get();
            $attendances =Attendance::whereBelongsTo($semester_programs)->get();

            // Define user collection if empty...
        } else {
            //  $users = User::
            //  $users = User::paginate($perPage = 25, $columns = ['*'], $pageName = "Users" );
            $attendances = $semester->attendance_sessions;

        }

        return $attendances;

    }

    // Check if attendance Has Absentees.
    public function hasAbsentees(){
        return DB::table('attendance_users')->where('attendance_id',$this->id)->where('is_present','!=',1)->exists();
    }
    
    // All Absent
    public function all_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('is_user', 1)
                    ->where('is_present','!=', 1)
                    ->withPivot('person_id');
    }

    // All Male Absentees
    public function all_gent_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'm')
                    ->where('is_user', 1)
                    ->where('is_present','!=', 1)
                    ->withPivot('person_id');
    }
    // All Female Absentees
    public function all_female_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'f')
                    ->where('is_user', 1)
                    ->where('is_present','!=', 1)
                    ->withPivot('person_id');
    }

    // Unavailable Absentees
    public function unavailable_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('is_user', 1)
                    ->where('is_present','=', 2)
                    ->withPivot('person_id');
    }

    // Unavailable gents Absentees
    public function unavailable_gent_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'm')
                    ->where('is_user', 1)
                    ->where('is_present','=', 2)
                    ->withPivot('person_id');
    }

    // Unavailable female Absentees
    public function unavailable_female_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'f')
                    ->where('is_user', 1)
                    ->where('is_present','=', 2)
                    ->withPivot('person_id');
    }

    // Available Absentees
    public function available_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('is_user', 1)
                    ->where('is_present','=', 0)
                    ->withPivot('person_id');
    }
    // Available Gent Absentees
    public function available_gent_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'm')
                    ->where('is_user', 1)
                    ->where('is_present','=', 0)
                    ->withPivot('person_id');
    }

    // Available Gent Absentees
    public function available_female_absentees(){
        return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'person_id')
                    ->where('is_member', 1)
                    ->where('gender', 'f')
                    ->where('is_user', 1)
                    ->where('is_present','=', 0)
                    ->withPivot('person_id');
    }

    // ABSENTEES FROM A ZONE
    public function zone_absentees(Zone $zone){
        return $this->all_absentees()->get()->intersect($zone->users());
    }

    // find Attendnace in session
    // public static function in_session(){
    //     return Attendance::where('in')
    // }

}
