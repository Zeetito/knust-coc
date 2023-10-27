<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You could do your authorizations here or in the routes
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        
                'firstname'=>['required','min:5','max:30'],
                'lastname'=>['required','min:5','max:30'],
                'username'=>['required','min:3','max:30', Rule::unique('users','username')],
                'email'=>['email','required', Rule::unique('users','email')],
                'password'=>['required','confirmed','max:225','min:6'],
          
        ];
    }
}
