<?php

    namespace App\Http\Requests\Order;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
        public function rules(): array
        {
            return [
                'first_name' => 'string|required',
                'last_name' => 'string|required',
                'address1' => 'string|required',
                'address2' => 'string|nullable',
                'coupon' => 'nullable|numeric',
                'phone' => 'numeric|required',
                'post_code' => 'string|nullable',
                'email' => 'string|required',
            ];
        }

        public function authorize(): bool
        {
            return true;
        }
    }
