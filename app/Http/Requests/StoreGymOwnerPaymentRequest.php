<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymOwnerPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('administrator');;
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
            //
        ];
    }
}
