<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guest;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SemesterProgram extends Model
{
    use HasFactory;

    
    protected $fillable = [
        
        'name',
        'venue',
        'start_date',
        'end_date',
        
    ];
    protected $dates = ['start_date', 'end_date'];
    // RELATIONSHIPS


    // FUNCTIONS
    public function get_start_date(){
        return Carbon::parse($this->start_date);
    }
    public function get_end_date(){
        return Carbon::parse($this->end_date);
    }

    // Is the Program today?
    public function is_today(){
        if( $this->get_start_date()->isToday() ){
            return true;
        }
    }

    // Programs for to day
    static function today_programs(){
        
        $today = Carbon::now()->toDateString();

        // Query for programs happening today using the isToday method
        $todayPrograms = self::where(function ($query) use ($today) {
            $query->whereDate('start_date', $today);
        })->get();

        return $todayPrograms;
    }

    // Get the academic period for every program
    public function academic_period(){
        $semester = Semester::findByDate($this->start_date);
        return "Semester ".$semester->name;
    }

    // OFFICIATORS FOR PROGRAMS

    // Two types of officiators
    // a.Those who are users and those who are guests

    // User Officiators
    public function user_officiators():belongsToMany{
        return $this->belongsToMany(User::class, 'officiators_programs', 'semester_program_id', 'officiator_id')->where('is_user',1)->withPivot('officiating_role_id','is_user');
    }

    // Guest Officators
    public function guest_officiators(): BelongsToMany{
        return $this->belongsToMany(Guest::class, 'officiators_programs', 'semester_program_id', 'officiator_id')->where('is_user',0)->withPivot('officiating_role_id','is_user');
    }

    // Get Sessions for program outlines
    public function sessions(){

     return  DB::table('program_outlines')
            ->where('semester_program_id', $this->id)
            ->get()
            ;

            }

    // Get the Names of All officiating roles.
    public static function all_officiating_roles(){
        return DB::table('officiating_roles')->get();
    }

    // Get a particular officiating role instance of a user/guest
    public function officiator_role($officiator){
        $officiating_role_id = $officiator->pivot->officiating_role_id;
        $instance = DB::table('officiators_programs')
                        // Using the is_user status to query for user or guest
                          ->where('is_user',$officiator->pivot->is_user)
                          ->join('officiating_roles','officiators_programs.officiating_role_id','officiating_roles.id')
                          ->where('officiator_id',$officiator->id)
                          ->where('officiating_role_id',$officiating_role_id)
                          ->where('semester_program_id',$this->id)
                          ->first()
                          ;
            return $instance;

    }
}