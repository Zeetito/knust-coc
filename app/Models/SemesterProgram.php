<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function get_start_date()
    {
        return Carbon::parse($this->start_date);
    }

    public function get_end_date()
    {
        return Carbon::parse($this->end_date);
    }

    // Is the Program today?
    public function is_today()
    {
        if ($this->get_start_date()->isToday()) {
            return true;
        }
    }

    // Programs for to day
    public static function today_programs()
    {

        $today = Carbon::now()->toDateString();

        // Query for programs happening today using the isToday method
        $todayPrograms = self::where(function ($query) use ($today) {
            $query->whereDate('start_date', $today);
        })->get();

        return $todayPrograms;
    }

    // Get the academic period for every program
    public function academic_period()
    {
        $semester = Semester::findByDate($this->start_date);

        return 'Semester '.$semester->name;
    }

    // OFFICIATORS FOR PROGRAMS

    // Two types of officiators
    // a.Those who are users and those who are guests

    // All Officiators
    public function all_officiators()
    {

    
        $officiators = [];
        foreach ($this->user_officiators as $officiator) {
            $officiators[] = [
                'officiators_programs_id' => $officiator->officiators_programs_id,
                'is_user' => 1,
                'name' => $officiator->fullname(),
            ];
        }
        foreach ($this->guest_officiators as $officiator) {
            $officiators[] = [
                'officiators_programs_id' => $officiator->officiators_programs_id,
                'is_user' => 0,
                'name' => $officiator->fullname,
            ];
        }

        return $officiators;
    }

    // User Officiators
    public function user_officiators(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'officiators_programs', 'semester_program_id', 'officiator_id')
            ->where('is_user', 1)
            ->select('*', 'officiators_programs.id as officiators_programs_id', 'officiators_programs.officiating_role_id')
            ->withPivot('officiating_role_id', 'is_user');
    }

    // Guest Officators
    public function guest_officiators(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class, 'officiators_programs', 'semester_program_id', 'officiator_id')
            ->where('is_user', 0)
            ->select('*', 'officiators_programs.id as officiators_programs_id', 'officiators_programs.officiating_role_id')
            ->withPivot('officiating_role_id', 'is_user');
    }

    // Get Sessions for program outlines
    public function sessions()
    {
        return DB::table('program_outlines')
            ->where('semester_program_id', $this->id)
            ->orderBy('position')
            ->get();
    }

    // Get the Names of All officiating roles.
    public static function all_officiating_roles()
    {
        return DB::table('officiating_roles')->get();
    }

    // Get a particular officiating role instance of a user/guest
    public function officiator_role($officiator)
    {
        $officiating_role_id = $officiator->pivot->officiating_role_id;

        return DB::table('officiating_roles')
            ->where('id', $officiating_role_id)
            ->first();

    }

    // PROGRAM OUTLINE
    public function outline()
    {
        return DB::table('program_outlines')
            ->where('semester_program_id', $this->id);
    }

    // Get the last outline's position
    public function last_session()
    {
        return $this->outline()->latest()->first();
    }
}
