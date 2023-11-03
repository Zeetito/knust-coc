<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Zone;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'pivot',
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

    public function residence()
    {
        return DB::table('residences')
            ->join('members_biodatas', 'members_biodatas.residence_id', '=', 'residences.id')
            ->whereColumn('members_biodatas.residence_id', 'residences.id')
            ->where('members_biodatas.user_id', $this->id)
            ->first();
    }

    // program
    public function program()
    {
        $program_id = $this->biodata()->program_id;

        return Program::where('id', $program_id)->first();
    }

    // zone
    public function zone()
    {
        $zone_id = $this->residence()->zone_id;

        return Zone::find($zone_id);

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
        return $this->program()->college();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_users');
    }

    // FUNCTIONS

    //Flagged -> Not functioning
    // PROFILE / BIODATA
    public function hasProfile()
    {
        // return exists($this->biodata()) ;
    }

    // Has Alumini Profile
    public function has_alumini_profile()
    {
        return DB::table('alumini_biodatas')
            ->where('user_id', $this->id)
            ->exists();
    }

    // Has Member Profile
    public function has_member_profile()
    {
        return DB::table('members_biodatas')
            ->where('user_id', $this->id)
            ->exists();
    }

    // BIODATA/PROFILE GET
    public function biodata()
    {
        if ($this->is_member == 1) {
            return DB::table('members_biodatas')
                ->where('user_id', $this->id)
                ->first();
        } else {
            return DB::table('alumini_biodatas')
                ->where('user_id', $this->id)
                ->first();
        }
    }

    // User Status - Whether a Non-Student Member, etc
    public function status()
    {

        // If User is a student
        if ($this->is_member == 1 && $this->is_student == 1) {
            return 'Student';
            // If member is not a student
        } elseif ($this->is_member == 1 && $this->is_student == 0) {

            // Check if user is Ns personelle and Alumini
            if ($this->has_member_profile() && $this->biodata()->ns_status == 1 && $this->biodata()->is_alumini == 1) {
                return 'N.S Personelle - Alumini Member';

                // If not Check if he's N.S Personelle and not alumini
            } elseif ($this->has_member_profile() && $this->biodata()->ns_status == 1) {
                return 'N.S Personelle';

                // IF not, check if He's an Alumini who worships with the church
            } elseif ($this->has_member_profile() && $this->biodata()->ns_status == 0 && $this->biodata()->is_alumini == 1) {
                return 'Alumini Member';
                // If Not user is a Non-Student Member
            } else {
                return 'Non-Student Member';
            }
            // If none of the above then user is an alumini who does not worship with us
        } elseif ($this->is_member == 0) {
            return 'Alumini';
        }
    }

    // Get User Active Biodata/Profile
    public function profile()
    {
        //  Check if user is a member else
        if ($this->is_member == 1) {
            return DB::table('members_biodatas')
                ->where('user_id', $this->id)
                ->first();
        } elseif ($this->is_member == 0) {
            return DB::table('alumini_biodatas')
                ->where('user_id', $this->id)
                ->first();
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
        if ($this->avatar === 'default_avatar') {
            return asset('img/avatars/default_avatar.jpg');
        }

        return asset('storage/img/avatars/'.$this->avatar);
    }

    // Check if User is checked for a particular attendance session
    public function is_checked(Attendance $attendance)
    {
        // return "chief";
        return DB::table('attendance_users')
            ->where('person_id', $this->id)
            ->where('attendance_id', $attendance->id)
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
}
