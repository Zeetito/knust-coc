<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $preserveKeys = true;

    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->when(isset($this->id), function () {
                return $this->id;
            }),
            'Fullname' => $this->fullname(),
            'Gender' => $this->gender,
            'Status' => $this->status(),
            'Email' => $this->email,

            // 'program' => $this->When($this->biodata()->exists(),function(){
            //     return $this->program->name;
            // }),


        ];
    }

    /**
     * Customize the outgoing response for the resource.
     */
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->header('X-Value', 'True');
    }
}
