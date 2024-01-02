<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'accountable_id',
        'semester_id',
        'accountable_type',
        'created_by',
        'type',
    ];

    // Find Ministry Involved
    public function ministry(){
        return $this->belongsTo(Role::class,'accountable_id');
    }

    // Get the Records For An Account Session
    public function records(){
        return $this->hasMany(AccountRecord::class);
    }

    // Find the Sum of the numeric values
    public function values_sum(){
        $positive = $this->records->where('sign','p')->where('included',1)->sum('value');
        $negative = $this->records->where('sign','n')->where('included',1)->sum('value');
        return (($positive-$negative));
    }

    // Find the Average of the values
    public function values_average(){
        return number_format(($this->values_sum() / $this->records->count()),2);
    }


}
