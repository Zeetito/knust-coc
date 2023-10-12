<?php

namespace App\Models;

use App\Models\User;
use App\Models\Zone;
use App\Models\Residence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    public function members(): hasManyThrough{
        return $this->hasManyThrough(User::class,Biodata::class,"residence_id","id","id","user_id");
    }

    public function zone(): belongsTo {
        return $this->belongsTo(Zone::class,"zone_id");
    }

     // FUNCTIONS
    // finid residence by name
    static function findResidenceByName($name){
        return Residence::where('name',$name)->first();
    
}

}
