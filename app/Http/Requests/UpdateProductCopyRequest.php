<?php

namespace App\Http\Requests;

use App\Models\ProductCopy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductCopyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $productCopy = ProductCopy::findOrFail($this->route('id'));
        return $this->user()->can('update', $productCopy);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productCopyId = $this->route('id');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_copies', 'name')->whereNull('deleted_at')->ignore($productCopyId),
            ],
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
            'name.required' => 'Naam is verplicht.',
            'name.max' => 'De lengte mag niet meer dan 255 karakters zijn',
            'is_published.required' => 'Publicatie status is verplicht.',
            'is_published.boolean' => 'Publicatie status moet een geldige waarde zijn.',
        ];
    }
}

