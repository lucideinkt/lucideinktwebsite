<?php

namespace App\Http\Requests;

use App\Models\DiscountCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $discountCodeId = $this->route('id');
        return [
            'code' => 'required|string|max:255|unique:discount_codes,code,'.$discountCodeId,
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:percent,amount',
            'discount' => 'required|numeric|min:0.01',
            'expiration_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_customer' => 'nullable|integer|min:1',
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
            'code.required' => 'De kortingscode is verplicht.',
            'code.unique' => 'Deze kortingscode bestaat al.',
            'discount_type.required' => 'Selecteer een kortingstype.',
            'discount_type.in' => 'Kies een geldig kortingstype.',
            'discount.required' => 'Vul een kortingsbedrag in.',
            'discount.numeric' => 'De korting moet een getal zijn.',
            'discount.min' => 'De korting moet minimaal 0,01 zijn.',
            'expiration_date.date' => 'Vul een geldige datum in.',
            'usage_limit.integer' => 'De gebruikslimiet moet een geheel getal zijn.',
            'usage_limit.min' => 'De gebruikslimiet moet minimaal 1 zijn.',
            'usage_limit_per_customer.integer' => 'De gebruikslimiet moet een geheel getal zijn.',
            'usage_limit_per_customer.min' => 'De gebruikslimiet moet minimaal 1 zijn.',
            'is_published.required' => 'Geef aan of de code gepubliceerd moet worden.',
            'is_published.boolean' => 'Ongeldige waarde voor publiceren.',
        ];
    }
}

