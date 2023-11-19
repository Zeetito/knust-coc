<?php

namespace App\Models;

use App\Models\MembersBiodata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        return User::WhereHas('member_biodata', function ($query) {
            $query->where('zone_id', $this->id);
        })->get();
        

        $users_id = User::where('is_member', 1)
            ->join('members_biodatas', 'users.id', '=', 'members_biodatas.user_id')
            ->join('residences', 'residences.id', '=', 'members_biodatas.residence_id')
            ->where('residences.zone_id', $this->id)
            ->pluck('users.id');

        return User::whereIn('id',$users_id)->get();
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

    // Search Zones
    // Search User By Name/Username
     public static function search(Request $request)
     {
 
         $string = $request->input('str');
         $str = '%'.$string.'%';

         if (! empty($string)) {
             $zones = Zone::where('name','like',$str);

         } else {

             $zones = Zone::orderBy('id');
 
         }
         // Retrieve the needed component
 
         return $users;
 
     }

    // finid Zone by name
    public static function findByName($name)
    {
        return self::where('name', $name)->first();

    }



}
