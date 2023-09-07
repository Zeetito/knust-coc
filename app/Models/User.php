<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    
    public function residence(): HasOne{
        return $this->HasOne(Residence::class);
    }
    
    public function zone(): HasOne{
        return $this->HasOne(Zone::class);
    }
    
    public function college(): HasOne{
        return $this->HasOne(College::class);
    }
    
    public function program(): HasOne{
        return $this->HasOne(Program::class);
    }

    // FUNCTIONS

    //Flagged -> Not functioning
    public function hasProfile() {
        return exists($this->biodata()) ;
    }

    public function get_avatar(){
        // return $this->avatar;
        return Storage::get("/storage/avatars/".$this->avatar);
    }

}
