<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'boundaries',
        'rep_id',

    ];

    // RELATIONSHIPS
    // public function users(): hasManyThrough{
    //     return $this->hasManyThrough(User::class,Residence::class);
    // }
    // public function users(): hasManyThrough{
    //     return $this->hasManyThrough(User::class,Biodata::class,"zone_id","id","id","user_id");
    // }

    // USERS_FOR NOW
    public function users()
    {
        return User::where('is_member', 1)
            ->join('biodatas', 'users.id', '=', 'biodatas.user_id')
            ->join('residences', 'residences.id', '=', 'biodatas.residence_id')
            ->where('residences.zone_id', $this->id)
            ->get()
            ->makeHidden(['biodata']);
    }

    // HOSTELS OR RESIDENCES
    public function residences()
    {
        return $this->hasMany(Residence::class);
        // return $this->hasManyThrough(Residence::class,Biodata::class,"zone_id","id","id","residence_id");

    }

    // ZONAL REPS
    public function reps()
    {
        return $this->hasMany(User::class, 'rep_id');
    }

    // EXTRA FRONTEND FUNCTIONS
    // public function zones_in_select_list(){
    //     $zones = $this->all();
    // }

}
