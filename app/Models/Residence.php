<?php

namespace App\Models;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function users(): hasMany{
        return $this->hasMany(User::class,"residence_id");
    }

    public function zone():belongsTo {
        return $this->belongsTo(Zone::class,"zone_id");
    }

}
