<?php

namespace App\Models;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Residence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;
use Illuminate\Database\Eloquent\Relations\hasOneThrough;

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
    public function members(): hasManyThrough{
        return $this->hasManyThrough(User::class,Biodata::class,"zone_id","id","id","user_id");
    }

    public function residences(): hasManyThrough{
        return $this->hasManyThrough(Residence::class,Biodata::class,"zone_id","id","id","residence_id");
    }

   


    // EXTRA FRONTEND FUNCTIONS
    // public function zones_in_select_list(){
    //     $zones = $this->all();
    // }

}
