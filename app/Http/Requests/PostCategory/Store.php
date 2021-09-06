<?php

    namespace App\Http\Requests\PostCategory;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
        public function rules(): array
        {
            return [
                'title'  => 'string|required',
                'status' => 'required|in:active,inactive',
            ];
        }

        public function authorize(): bool
        {
            return true;
        }
    }