<?php

namespace App\Models;

use App\Models\User;
use App\Models\Residence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
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

    public function users(): hasManyThrough{
        return $this->hasManyThrough(User::class,Residence::class);
    }
    public function residences(): hasMany {
        return $this->hasMany(Residence::class);
    }

}
