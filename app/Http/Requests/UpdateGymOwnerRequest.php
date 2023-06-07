<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGymOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('administrator');;
    }

    protected function prepareForValidation()
    {
        // Set the user ID based on the existing user
        $this->merge([
            'user_id' => $this->route('gym_owner')->user_id,
            //'logo' => $this->logo ?? $this->route('gym_owner')->logo,
            //'legal_docs' => $this->legal_docs ?? $this->route('gym_owner')->legal_docs,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'gym_name' => 'required|string',
            'owner_name' => 'required|string',
            'registration_number' => 'required|string',
            'contact_phone' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'logo' => 'sometimes|nullable|file',
            'opening_hours' => 'required|string',
            //'social_media_links' => 'required|string',
            'address' => 'required|string',
            'legal_docs' => 'sometimes|nullable|file',
            'user_id' => 'required|exists:users,id'
            //
        ];
    }
}
