<?php

namespace App\Http\Resources;

use App\Models\Zone;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use App\Models\YearGroup;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Resources\Json\JsonResource;

class BiodataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'academic_year' => $this->when(isset($this->academic_year_id), function () {
                
                return optional(AcademicYear::find($this->academic_year_id))->start_year."-".optional(AcademicYear::find($this->academic_year_id))->end_year;
            }),
            'year' => $this->when(isset($this->year), function () {
                return $this->year;
            }),
            'program' => $this->when(isset($this->program_id), function () {
                return optional(Program::find($this->program_id))->name;
            }),
            'college' => $this->when(isset($this->college_id), function () {
                return optional(College::find($this->college_id))->name;
            }),
            'residence' => $this->when(isset($this->residence_id), function () {
                return optional(Residence::find($this->residence_id))->name;
            }),
            'zone' => $this->when(isset($this->zone_id), function () {
                return optional(Zone::find($this->zone_id))->name;
            }),
            'room' => $this->when(isset($this->room), function () {
                return $this->room;
            }),
            'ns_status' => $this->when(isset($this->ns_status) && $this->ns_status == 1, function () {
                return $this->ns_status;
            }),
            'is_alumini' => $this->when(isset($this->is_alumini), function () {
                return $this->is_alumini;
            }),
            'year_group' => $this->when(isset($this->year_group_id), function () {
                return optional(YearGroup::find($this->year_group_id))->name;
            }),
            'country' => $this->when(isset($this->country), function () {
                return $this->country;
            }),
            'state' => $this->when(isset($this->state), function () {
                return $this->state;
            }),
            'city' => $this->when(isset($this->city), function () {
                return $this->city;
            }),
            'local_congregation' => $this->when(isset($this->local_congregation_id), function () {
                return $this->local_congregation_id;
            }),
            // Add other fields here
        ];
    }
}
