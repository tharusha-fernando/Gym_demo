<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class CreateGymMemberAccountRequest extends FormRequest
{
    use PasswordValidationRules;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('gym_owner');;
    }

    protected function prepareForValidation()
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            //
        ];
    }
}
