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
            'Username' => $this->when(isset($this->username), function () {
                return $this->username;
            }),
            'FirstName' => $this->when(isset($this->firstname), function () {
                return $this->firstname;
            }),
            'Lastname' => $this->when(isset($this->lastname), function () {
                return $this->lastname;
            }),
            'Othername' => $this->when(isset($this->othername), function () {
                return $this->othername;
            }),
            'Gender' => $this->when(isset($this->gender), function () {
                return $this->gender;
            }),
            'DateOfBirth' => $this->when(isset($this->dob), function () {
                return $this->dob;
            }),
            'Email' => $this->when(isset($this->email), function () {
                return $this->email;
            }),

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
