<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|min:2',
            'email' => 'email|required',
            'message' => 'required|min:20|max:200',
            'subject' => 'string|required',
            'phone' => 'numeric|required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
