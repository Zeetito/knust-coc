<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function biodata():HasOne{
        return $this->HasOne(Biodata::class,'user_id');
    }

    public function hasProfile() {

        return exists($this->biodata()) ;
        // return ($this->HasOne(Biodata::class,'user_id') = TRUE);
    }

    public function avatar(){
        return $this->avatar;
    }

    public function residence(): hasOne{
        return $this->hasOne(Residence::class);
    }

    public function zone(): hasOne{
        return $this->hasOne(Zone::class);
    }

    public function college(): hasOne{
        return $this->hasOne(College::class);
    }

    public function program(): hasOne{
        return $this->hasOne(Program::class);
    }
}
