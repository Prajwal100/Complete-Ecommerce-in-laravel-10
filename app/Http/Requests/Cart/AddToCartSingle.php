<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartSingle extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => 'required',
            'quant' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
