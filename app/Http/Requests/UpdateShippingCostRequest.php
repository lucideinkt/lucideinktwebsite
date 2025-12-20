<?php

namespace App\Http\Requests;

use App\Models\ShippingCost;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingCostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $shippingCost = ShippingCost::findOrFail($this->route('id'));
        return $this->user()->can('update', $shippingCost);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
            'country' => 'required|string|max:255',
            'is_published' => 'required|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Bedrag is verplicht.',
            'amount.numeric' => 'Bedrag moet een getal zijn.',
            'amount.min' => 'Bedrag moet minimaal 0 zijn.',
            'country.required' => 'Land is verplicht.',
            'country.max' => 'Land mag niet meer dan 255 karakters zijn.',
            'is_published.required' => 'Publicatie status is verplicht.',
            'is_published.boolean' => 'Publicatie status moet een geldige waarde zijn.',
        ];
    }
}

