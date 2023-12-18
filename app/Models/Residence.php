<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zone_id',
        'description',
        'landmark',
        'rep_id',
    ];

    // RELATIONSHIPS
    public function members(): hasManyThrough
    {
        return $this->hasManyThrough(User::class, Biodata::class, 'residence_id', 'id', 'id', 'user_id');
    }

    public function zone(): belongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    // FUNCTIONS
    // finid residence by name
    public static function findResidenceByName($name)
    {
        return Residence::where('name', $name)->first();

    }

    public function search(Request $request){
        $string = $request->input('str');
        $str = '%'.$string.'%';

        // Check if the input is empty or not
        // Define user collection if not...
        if (! empty($string)) {
            $residences = Residence::
                            //Searching firstname,lastname and username
                            where('name','like', $str);

            // Define user collection if empty...
        } else {
            //  $residences = User::
            //  $residences = User::paginate($perPage = 25, $columns = ['*'], $pageName = "residences" );
            $residences = Residence::orderBy('id');

        }
        // Retrieve the needed component

        return $residences;
    }

    // Find the User of a Custom Residence
    public static function custom_residence_user($residence){
        // $user_id = DB::table('user_residences')->where('id',$residence->id)->first()->user_id;
        $user_id = $residence->user_id;
        return User::find($user_id);
    }
}
