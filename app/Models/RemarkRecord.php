<?php

namespace App\Models;

use App\Models\User;
use App\Models\Remark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RemarkRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'remark_id',
        'body',
        'type',
    ];

    // Get the related Remark
    public function remark(){
        return $this->belongsTo(Remark::class);
    }

    // Get the recorded by relationship
    public function recorded_by(){
        return $this->belongsTo(User::class,'created_by');
    }
}
