<?php

namespace App\Http\Requests;

use App\Constants\FieldTypeConsts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fields' => ['required', 'array'],
            'fields.*.name' => ['required', 'string'],
            'fields.*.type' => ['required', 'string', Rule::in(FieldTypeConsts::getAll())],
            'fields.*.required' => ['nullable', 'bool'],
        ];
    }
}
