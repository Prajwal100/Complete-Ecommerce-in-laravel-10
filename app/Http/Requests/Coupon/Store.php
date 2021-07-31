<?php

    namespace App\Http\Requests\Coupon;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
        public function rules(): array
        {
            return [
                'code'   => 'string|required|unique:coupons',
                'type'   => 'required|in:fixed,percent',
                'value'  => 'required|numeric',
                'status' => 'required|in:active,inactive',
            ];
        }

        public function authorize(): bool
        {
            return true;
        }
    }
