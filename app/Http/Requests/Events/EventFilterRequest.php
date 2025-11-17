<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class EventFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'perPage' => ['nullable', 'integer', 'min:1'],
            'orderBy' => ['nullable'],
            'direction' => ['nullable'],
        ];
    }
}
