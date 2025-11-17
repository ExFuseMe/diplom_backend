<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'second_name' => ['required'],
            'last_name' => ['nullable'],
            'phone' => ['required'],
            'group' => ['required'],
            'vk' => ['nullable', 'unique:users,vk'],
            'birthday' => ['required', 'date', 'before:today'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
}
