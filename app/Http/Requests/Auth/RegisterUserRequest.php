<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'nickname' => 'required',
            'occupation' => 'required',
            'password' => 'required',
        ];
    }
}
