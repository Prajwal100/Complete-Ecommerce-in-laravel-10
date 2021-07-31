<?php

    namespace App\Http\Requests\Product;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
        /**
         * @var mixed
         */
        public $category;

        public function rules(): array
        {
            return [
                'title'        => 'string|required',
                'summary'      => 'string|required',
                'description'  => 'string|nullable',
                'photo'        => 'string|required',
                'size'         => 'nullable',
                'stock'        => "required|numeric",
                'cat_id'       => 'required|exists:categories,id',
                'brand_id'     => 'nullable|exists:brands,id',
                'child_cat_id' => 'nullable|exists:categories,id',
                'is_featured'  => 'sometimes|in:1',
                'status'       => 'required|in:active,inactive',
                'condition'    => 'required|in:default,new,hot',
                'price'        => 'required|numeric',
                'discount'     => 'nullable|numeric',
            ];
        }

        public function authorize(): bool
        {
            return true;
        }
    }
