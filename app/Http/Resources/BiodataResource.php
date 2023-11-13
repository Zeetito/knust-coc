<?php

namespace App\Http\Resources;

use App\Models\Zone;
use App\Models\College;
use App\Models\Program;
use App\Models\Residence;
use App\Models\YearGroup;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
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
        $data = [

                'academic_year' => isset($this->academic_year_id) ? AcademicYear::find($this->academic_year_id)->name : null,
                'year' => isset($this->year) ? $this->year : null,
                'program' => isset($this->program_id) ? Program::find($this->program_id)->name : null,
                'college' => isset($this->college_id) ? College::find($this->college_id)->name : null,
                'residence' => isset($this->residence_id) ? Residence::find($this->residence_id)->name : null,
                'zone' => isset($this->zone_id) ? Zone::find($this->zone_id)->name : null,
                'room' => isset($this->room) ? $this->room : null,
                'ns_status' => isset($this->ns_status) ? $this->ns_status : null,
                'is_alumini' => isset($this->is_alumini) ? $this->is_alumini : null,
                'year_group' => isset($this->year_group_id) ? YearGroup::find($this->year_group_id)->name : null,
                'country' => isset($this->country) ? $this->country : null,
                'state' => isset($this->state) ? $this->state : null,
                'city' => isset($this->city) ? $this->city : null,
                'local_congregation' => isset($this->local_congregation_id) ? $this->local_congregation_id : null,

        ];
                // Remove keys with null values or unset keys that don't exist
                foreach ($data as $key => $value) {
                    if ($value === null) {
                        unset($data[$key]);
                    }
                }
                return $data;
    }
}
