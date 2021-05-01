<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
