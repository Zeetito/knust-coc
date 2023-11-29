<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DTD extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location_id',
        'is_zone',
        'visibility',
        'info',
        'academic_year_id',
        'created_by',
    ];


    // Groups
    public function groups(){
        return $this->morphMany(Group::class, 'groupable');
    }

    // Return Dtd_persons instances for a Dtd group instance
    public function group_records(Group $group){
        return DB::table('dtd_persons')
                ->where('d_t_d_s_id',$this->id)
                ->where('group_id',$group->id)
                ->get()
                ->sortBy('room')
                ;
    }

}
