<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Zone;
use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Group;
use App\Models\Image;
use App\Models\College;
use App\Models\Contact;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Residence;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\UserRequest;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use App\Models\AlumniBiodata;
use App\Models\MembersBiodata;
use App\Models\SemesterProgram;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRolesAndPermissions, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'othername',
        'dob',
        'email',
        'is_student',
        'is_member',
        'gender',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Nb.. if the file is deleted, it would show somthing else and not the fall-back avatar
    //  protected function avatar(): Attribute{
    //     return Attribute::make(get: function($value) {
    //         return $value ? "/storage/img/avatars/".$value : "/img/default_avatar.jpg";
    //     });
    // }

    // RELATIONSHIPS

    // Retrieve Images of a user.
    public function photos(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function residence()
    {
        if($this->biodata->residence){
            return $this->biodata->residence;
        }else{
                return $this->custom_residence() ? $this->custom_residence() : Null;
        }
    }

    // Check if User has custom residence
    public function has_custom_residence(){
        $academic_year_id = Semester::active_semester()->academicYear->id;
        return DB::table('user_residences')->where('academic_year_id',$academic_year_id)->where('user_id',$this->id)->exists();
    }

    // Get User Custom Residence
    public function custom_residence(){
        $academic_year_id = Semester::active_semester()->academicYear->id;
        return DB::table('user_residences')->where('academic_year_id',$academic_year_id)->where('user_id',$this->id)->first();
    }

    // program
    public function program()
    {
        if($this->biodata->program){
            return $this->biodata->program;
        }else{
               
                return $this->custom_program() ? $this->custom_program() : Null;
        }
    }

    // Check if User has custom residence
    public function has_custom_program(){
        $academic_year_id = Semester::active_semester()->academicYear->id;
        return DB::table('user_programs')->where('academic_year_id',$academic_year_id)->where('user_id',$this->id)->exists();
    }

    // Get User Custom program
    public function custom_program(){
        $academic_year_id = Semester::active_semester()->academicYear->id;
        return DB::table('user_programs')->where('academic_year_id',$academic_year_id)->where('user_id',$this->id)->first();
    }

    // zone
    public function zone()
    {
        if($this->biodata->zone){
            return $this->biodata->zone;
        }else{
            $zone['name'] = "OTHERS";
            $zone = Zone::make($zone); 
            return $zone;
        }

    }
    // Room
    public function room(){
        return $this->biodata->room;
    }
    

    // faculty
    public function faculty()
    {
        return $this->program()->faculty;
    }

    // department
    public function department()
    {
        return $this->program()->department;
    }

    // college
    public function college()
    {
        if($this->biodata->program){
            return $this->program()->college;
        }else{
            $college = College::find($this->custom_program()->college_id);
            return $college;
        }
    }

    // Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    // Permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_users');
    }

    // LocalCongregation Of Non Member Users
    public function local_congregation()
    {
        return $this->biodata->local_congregation;
    }

    // Get the Year of A student user
    public function year()
    {
        return $this->biodata->year;
    }

    // Contacts
    public function contacts(){
        return $this->hasMany(Contact::class)->orderByDesc('ownership');
    }

    // Getting Main Phone Number
    public function phone(){
        return $this->hasOne(Contact::class)
                ->where('type','phone');
    }

    // Getting Main whatsapp Number
    public function whatsapp(){
        return $this->hasOne(Contact::class)
                ->where('type','whatsapp');
    }

    // Getting Main school_voda Number
    public function school_voda(){
        return $this->hasOne(Contact::class)
                ->where('type','school_voda');
    }

    // Getting Main other Number
    public function other_contact(){
        return $this->hasOne(Contact::class)
                ->where('type','other_contact');
    }

    // Getting Main Guardian Contact
    public function main_guardian_contact(){
        return $this->hasOne(Contact::class)
                ->where('type','guardian')
                ->where('is_main','1')
                ;
    }
    // Other Guardian Contact
    public function other_guardian_contact(){
        return $this->hasOne(Contact::class)
                ->where('type','guardian')
                ->where('is_main','0')
                ;
    }

    // Get User Main Contact
    public function main_contact(){
        return $this->hasOne(Contact::class)
        ->where('ownership','personal')
        ->where('is_main','1')
        ;
    }

    // Groups
    // Retrieve Groups of a user.
    public function groups()
    {
        return $this->belongsToMany(Group::class,'group_users','user_id','group_id')
                ->where('is_member',1)
                ->where('is_active',1)
                ->latest();
    }
    public function invites()
    {
        return $this->belongsToMany(Group::class,'group_users','user_id','group_id')
        ->where('is_member',0)
        ->latest();
    }

    // FUNCTIONS

    // PROFILE / BIODATA

    public function hasProfile()
    {
        // return exists($this->biodata) ;
    }

    // Has Alumni Profile
    public function has_alumni_profile()
    {
        // Check if Member is currently an alumni
        if ($this->member == 0) {
            return DB::table('alumni_biodatas')
                ->where('academic_year_id', Semester::active_semester()->academicYear->id)
                ->where('user_id', $this->id)
                ->exists();
        }
    }

    // Has Member Profile
    public function has_member_profile()
    {
        if ($this->is_member == 1) {
            return DB::table('members_biodatas')
                ->where('academic_year_id', Semester::active_semester()->academicYear->id)
                ->where('user_id', $this->id)
                ->exists();
        }
    }

    // biodata Get
    public function biodata()
    {
        // Check if user is a member
        if ($this->is_member == 1) {
            return $this->hasOne(MembersBiodata::class)
                        ->latest();

            // Check if user ia an alumni
        } elseif ($this->is_member == 0) {
            return $this->hasOne(AlumniBiodata::class)
                        ->latest();
        }else{
            return null;
        }
    }

    // Get Member Biodata
    public function member_biodata(){
        return $this->hasOne(MembersBiodata::class)
        ->latest();
    }
    // Get Alumni Biodata
    public function alumni_biodata(){
        return $this->hasOne(AlumniBiodata::class)
        ->latest();
    }

    // Get members with no current Biodata
    public static function without_biodata(){
        return User::whereDoesntHave('alumni_biodata')->whereDoesntHave('member_biodata');
    }

    // Get User Contact when He was Guest
    public function when_guest(){
        $when_guest = Guest::find(GuestRequest::where('instance_id',$this->id)->where('table_name','users')->first()->guest_id);
        return $when_guest;
    }

    // Check if User was once a guest
    public function was_a_guest(){
        $when_guest = Guest::find(GuestRequest::where('instance_id',$this->id)->where('table_name','users')->first());
        return $when_guest;
    }

    // User Status - Whether a Non-Student Member, etc
    public function status()
    {

        // If User is a student
        if ($this->is_member == 1 && $this->is_student == 1) {
            return 'Student';
            // If member is not a student
        } elseif ($this->is_member == 1 && $this->is_student == 0) {

            // Check if user is Ns personelle and Alumni
            if ($this->has_member_profile() && $this->biodata->ns_status == 1 && $this->biodata->is_alumni == 1) {
                return 'N.S Personelle - Alumni Member';

                // If not Check if he's N.S Personelle and not alumni
            } elseif ($this->has_member_profile() && $this->biodata->ns_status == 1) {
                return 'N.S Personelle';

                // IF not, check if He's an Alumni who worships with the church
            } elseif ($this->has_member_profile() && $this->biodata->ns_status == 0 && $this->biodata->is_alumni == 1) {
                return 'Alumni Member';
                // If Not user is a Non-Student Member
            } else {
                return 'Non-Student Member';
            }
            // If none of the above then user is an alumni who does not worship with us
        } elseif ($this->is_member == 0) {
            return 'Alumni';
        }
    }

    // Get user full name
    public function fullname()
    {
        return $this->firstname.' '.$this->lastname;
    }

    // Get User Avatar
    public function get_avatar()
    {
        // return $this->avatar;
        if ($this->avatar == 'default_avatar') {
            if ($this->gender == 'm') {
                return asset('img/avatars/male_avatar.jpg');
            } else {
                return asset('img/avatars/female_avatar.jpg');
            }
        }
        return Storage::disk('public')->url('img/avatars/'.$this->avatar);
        // return asset('storage/img/avatars/'.$this->avatar);
    }

    // Check if User is checked for a particular attendance session
    public function is_checked(Attendance $attendance)
    {
        // return "chief";
        return DB::table('attendance_users')
            ->where('person_id', $this->id)
            ->where('attendance_id', $attendance->id)
            ->where('is_present', 1)
            ->exists();
    }

    // Return User who checkd this user
    public function checked_by(Attendance $attendance)
    {

        return self::join('attendance_users', 'attendance_users.checked_by', '=', 'users.id')
            ->where('attendance_users.attendance_id', $attendance->id)
            ->where('attendance_users.person_id', $this->id)
            ->select('users.*')
            ->limit(1)
            ->first();
    }

    // Programs officiated by the user
    public function programsOfficiated()
    {
        return $this->belongsToMany(SemesterProgram::class, 'officiators_programs', 'officiator_id', 'semester_program_id');
    }

    // STATIC FUNCTIONS

    // Search User By Name/Username
    public static function search_user(Request $request)
    {

        $string = $request->input('str');
        $str = '%'.$string.'%';

        // Check if the input is empty or not
        // Define user collection if not...
        if (! empty($string)) {
            $users = User::
                            //Searching firstname,lastname and username
                            where((DB::raw("CONCAT(firstname, ' ', lastname, username)")), 'like', $str)
                                ->orWhere((DB::raw("CONCAT(lastname, ' ', firstname, username)")), 'like', $str);

            // Define user collection if empty...
        } else {
            //  $users = User::
            //  $users = User::paginate($perPage = 25, $columns = ['*'], $pageName = "Users" );
            $users = User::orderBy('id');

        }
        // Retrieve the needed component

        return $users;

    }

    // Search Users 50 paginate
    public static function paginate50()
    {
        return User::paginate($perPage = 50, $columns = ['*'], $pageName = 'Users');
    }

    // InActive Accounts Check
    public static function inactive_accounts()
    {
        return User::where('is_activated', 0);
    }

    // Check User Account Status, Active or inactive
    public function account_status()
    {
        if ($this->is_activated) {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }

    // Return Reason for an inactive Account
    public function inactive_account_reason()
    {
        if ($this->account_status() == 'Inactive') {
            return DB::table('inactive_accounts')
                ->where('user_id', $this->id)
                ->first()->category;
        }
    }

    // Get Members who are unavailable
    public static function unavailable_members()
    {
        return User::where('is_member', 1)
            ->where('is_available', 0);
    }

    // Get Unavailable Member category
    public function unavailable_member_category()
    {
        if ($this->is_available == 0) {
            return DB::table('unavailable_members')
                ->where('user_id', $this->id)
                ->first()->category;
        }
    }

    // Get Unavailable Member Info
    public function unavailable_member_info()
    {
        if ($this->is_available == 0) {
            return DB::table('unavailable_members')
                ->where('user_id', $this->id)
                ->first()->info;
        }
    }

    // User Program Mates Get
    public function program_mates()
    {
        $program_mates_id = DB::table('users')->where('is_student', 1)
            ->where('is_member', 1)
            ->where('users.id', '<>', $this->id)
            ->join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
            ->where('members_biodatas.program_id', $this->program()->id)
            ->pluck('users.id');

        return User::whereIn('id', $program_mates_id)->get();
    }

    // Check IF user has pendeing requests
    public function pending_requests(){
        return $this->hasMany(UserRequest::class)
                    ->where('is_handled',0);
    }

    // Get All Users with Pending requests
    public static function users_with_pending_request(){
        return self::has('pending_requests');
    }


    // // Get User requests
    public static function user_requests(){
        return UserRequest::where('is_handled',0)->latest();
    }

    // Absent Status
    public function absentee_status(Attendance $attendance){
        return DB::table('attendance_users')->where('attendance_id',$attendance->id)->where('is_user',1)->where('person_id',$this->id)->first()->is_present;
    }

    public function absentee_reason(Attendance $attendance){
        return DB::table('attendance_users')->where('attendance_id',$attendance->id)->where('is_user',1)->where('person_id',$this->id)->first()->reason;
    }

    // Attendance Instance
    public function attendance_instance(Attendance $attendance){
        return  DB::table('attendance_users')->where('attendance_id',$attendance->id)->where('is_user',1)->where('person_id',$this->id);
    }

    // Check If User has Invites
    public function has_invites(){
        return DB::table('group_users')
                ->where('user_id',$this->id)
                ->where('is_member',0)
                ->exists()
                ;
    }

    // Check If User is a Member of A group
    public function is_member_of(){
        return DB::table('group_users')
                ->where('user_id',$this->id)
                ->where('is_member',1)
                ->exists()
                ;
    }

    // Check if user is an admin for a group
    public function is_admin_for(Group $group){
        return DB::table('group_users')
        ->where('user_id',$this->id)
        ->where('is_member',1)
        ->where('is_admin',1)
        ->exists()
        ; 
    }

    // Check if User is creator of A group
    public function is_creator_for(Group $group){
        return $group->created_by == $this->id;
        
    }

}
