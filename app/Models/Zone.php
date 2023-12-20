<?php

namespace App\Models;

use App\Models\MembersBiodata;
use Illuminate\Support\Facades\DB;
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
        })->union(
            User::whereHas('custom_residence', function ($query) {
            $query->where('zone_id',$this->id);
            })
        )->get();
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

    public static function OtherZone(){
        $zone['name'] = "Others";
        return $zone;
    }

    public static function otherZoneMembers(){
        return User::WhereHas('member_biodata', function ($query) {
            $query->where('zone_id', null);
        })
        ->WhereHas('custom_residence', function ($query) {
            $query->where('zone_id', null);
    })
        ->get();
    }

    public static function otherZoneResidences(){
        return UserResidence::where('category','hostel')->orWhere('category','homestel')->get();
    }



}
