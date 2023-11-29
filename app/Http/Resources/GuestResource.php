<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'Fullname' => $this->fullname,
            'Gender' => $this->gender,
            'Church' => $this->local_congregation,
            'Status' => $this->status,
            'Email' => $this->email,
            'Contact' => $this->contact,
       ];
    }
}
