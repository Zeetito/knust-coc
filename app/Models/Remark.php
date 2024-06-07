<?php

namespace App\Models;

use App\Models\Role;
use App\Models\RemarkRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Remark extends Model
{
    use HasFactory;

    protected $fillable =   
    [
        'remarkable_id', // the Model to be remarked
        'remarkable_type',
        'body',
        'remarkerable_id', // The Model giving the remarks
        'remarkerable_type',
        'semester_id',
        
    ];

    // retrieve related model remarked
    public function remarkable(){
        return $this->morphTo();
    }

    // return model doing the remark
    public function remarkerable(){
        return $this->morphTo();
    }

    // Get remark records
    public function records(){
        return $this->hasMany(RemarkRecord::class);
    }
}
