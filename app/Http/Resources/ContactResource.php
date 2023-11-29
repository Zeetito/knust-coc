<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_name' => $this->when(isset($this->user_id), function () {
                return optional(User::find($this->user_id))->fullname();
            }),
            'body' => $this->when(isset($this->body), function () {
                return $this->body;
            }),
            'type' => $this->when(isset($this->type), function () {
                return $this->type;
            }),
            'ownership' => $this->when(isset($this->ownership), function () {
                return $this->ownership;
            }),
            'relation' => $this->when(isset($this->relation), function () {
                return $this->relation;
            }),
            
        ];
    }
}
