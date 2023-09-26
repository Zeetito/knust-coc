<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use App\Models\Attendance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'is_student',
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
    public function biodata(): HasOne{
        return $this->HasOne(Biodata::class);
    }

    
    public function residence(): HasOneThrough{
        return $this->HasOneThrough(Residence::class,Biodata::class,"user_id","id","id","residence_id");
    }
    
    public function zone(): HasOneThrough{
        return $this->HasOneThrough(Zone::class,Biodata::class,"user_id","id","id","zone_id");
    }
    
    public function college(): HasOne{
        return $this->HasOne(College::class,Biodata::class,"user_id","id","id","college_id");
    }
    
    public function program(): HasOneThrough{
        return $this->HasOneThrough(Program::class,Biodata::class,"user_id","id","id","program_id");
    }

    // FUNCTIONS

    //Flagged -> Not functioning
    public function hasProfile() {
        return exists($this->biodata()) ;
    }

    public function get_avatar(){
        // return $this->avatar;
        if ($this->avatar === "default_avatar"){
            return asset('img/avatars/default_avatar.jpg');
        }
            return (asset('storage/img/avatars/'.$this->avatar));
    }

    public function is_checked(Attendance $attendance) {
        // return "chief";
        return DB::table('attendance_users')
        ->where('user_id',$this->id)
        ->where('attendance_id',$attendance->id)
        ->exists();
    }

    public function checked_by(Attendance $attendance) {
       
        return  self::
                join('attendance_users','attendance_users.checked_by','=','users.id')
                ->where('attendance_users.attendance_id',$attendance->id)
                ->where('attendance_users.user_id',$this->id)
                ->select('users.*')
                ->limit(1)
                ->first()
                ;
    }

}
