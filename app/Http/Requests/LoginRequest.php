<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:3'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (! auth()->attempt($this->safe(['email', 'password']))) {
                    $validator->errors()->add('password', 'These credentials do not match our records.');
                }
            },
        ];
    }
}
