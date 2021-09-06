<?php

namespace App\Http\Requests\Password;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed new_password
 */
class Store extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
