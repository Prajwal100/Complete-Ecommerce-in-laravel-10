<?php

    namespace App\Http\Requests\Review;

    use Illuminate\Foundation\Http\FormRequest;

    class Store extends FormRequest
    {
      /**
       * @var mixed
       */
      public $slug;

      public function rules(): array
      {
        return [
            'rate' => 'required|numeric|min:1',
        ];
      }

      public function authorize(): bool
      {
        return true;
      }
    }
