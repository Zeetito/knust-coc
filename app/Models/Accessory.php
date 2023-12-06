<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'description',
        'value'
    ];

    public static function getSystemStatus()
    {
        return Accessory::where('name', 'system_online')->first();
    }

}
