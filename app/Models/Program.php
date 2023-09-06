<?php

namespace App\Models;

use App\Models\User;
use App\Models\College;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'college_id',
        'span',
       
    ];

    public function users(): hasMany{
        return $this->hasMany(User::class);
    }

    public function college(): belongsTo {
        return $this->belongsTo(College::class);
    }

}
