<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('gym_owner');;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'gym_owner_id' => auth()->user()->id,
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
            'name'=>'required|string',
            'price'=>'required|string',
            'description'=>'required|string',
            'member_count'=>'sometimes|nullable|numeric',
            'price_'=>'sometimes|nullable|string',
            'gym_owner_id'=>'required|exists:gym_owners,id'
            //
        ];
    }
}
