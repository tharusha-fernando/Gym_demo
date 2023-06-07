<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymTrainerPaymentRequest extends FormRequest
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
            'amount'=>'required|numeric',
            'commission'=>'sometimes|nullable|numeric',
            'payment_type'=>'required|string',
            'gym_owner_id'=>'required|exists:gym_owners,id',
            'gym_trainer_id'=>'required|exists:gym_trainers,id',
            //
        ];
    }
}
