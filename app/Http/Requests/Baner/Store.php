<?php

    namespace App\Http\Requests\Baner;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
        public function rules(): array
        {
            return [
                'title'       => 'string|required|max:50|unique:banners',
                'description' => 'string|nullable',
                'photo'       => 'string|required',
                'status'      => 'required|in:active,inactive',
            ];
        }

        public function authorize(): bool
        {
            return true;
        }
    }
