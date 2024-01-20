<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uploadable_id',
        'uploadable_type',
        'semester_id',
    ];

    // Who Uploaded The File
    public function uploadable(){
        return $this->morphTo();
    }

    
}
