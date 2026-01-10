<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductCopy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'is_published' => 'required|boolean',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:product_categories,id',
            'product_copy_id' => 'nullable|integer|exists:product_copies,id',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'depth' => 'nullable|numeric|min:0',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     *
     * @return array
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $validated = $validator->validated();
                $title = trim($validated['title'] ?? '');
                
                if (empty($title)) {
                    return;
                }

                $copy = !empty($validated['product_copy_id'])
                    ? ProductCopy::find($validated['product_copy_id'])
                    : null;

                // base_title altijd zonder exemplaar
                if ($copy && $copy->name) {
                    $baseTitle = preg_replace('/\s*-\s*'.preg_quote($copy->name, '/').'$/iu', '', $title);
                } else {
                    $baseTitle = $title;
                }

                // title = base_title + exemplaar (indien aanwezig)
                if ($copy && $copy->name) {
                    $title = $baseTitle.' - '.$copy->name;
                }

                // Uniekheid check
                if (Product::where('title', $title)->whereNull('deleted_at')->exists()) {
                    $validator->errors()->add('title', 'Deze producttitel bestaat al.');
                }
            }
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
            'title.required' => 'De productnaam is verplicht.',
            'title.string' => 'De productnaam moet tekst zijn.',
            'title.max' => 'De productnaam mag maximaal 255 tekens zijn.',
            'is_published.required' => 'Geef aan of het product gepubliceerd is.',
            'is_published.boolean' => 'Ongeldige waarde voor gepubliceerd.',
            'short_description.string' => 'Korte omschrijving moet tekst zijn.',
            'long_description.string' => 'Lange omschrijving moet tekst zijn.',
            'price.numeric' => 'Prijs moet een getal zijn.',
            'price.min' => 'Prijs mag niet negatief zijn.',
            'stock.numeric' => 'Voorraad moet een getal zijn.',
            'stock.min' => 'Voorraad mag niet negatief zijn.',
            'category_id.exists' => 'Ongeldige categorie.',
            'product_copy_id.exists' => 'Ongeldige kopie.',
            'weight.numeric' => 'Gewicht moet een getal zijn.',
            'weight.min' => 'Gewicht mag niet negatief zijn.',
            'height.numeric' => 'Hoogte moet een getal zijn.',
            'height.min' => 'Hoogte mag niet negatief zijn.',
            'width.numeric' => 'Breedte moet een getal zijn.',
            'width.min' => 'Breedte mag niet negatief zijn.',
            'depth.numeric' => 'Diepte moet een getal zijn.',
            'depth.min' => 'Diepte mag niet negatief zijn.',
            'image_1.image' => 'Afbeelding 1 moet een afbeelding zijn.',
            'image_1.mimes' => 'Afbeelding 1 moet jpeg, png, jpg, gif of svg zijn.',
            'image_1.max' => 'Afbeelding 1 mag maximaal 2MB zijn.',
            'image_2.image' => 'Afbeelding 2 moet een afbeelding zijn.',
            'image_2.mimes' => 'Afbeelding 2 moet jpeg, png, jpg, gif of svg zijn.',
            'image_2.max' => 'Afbeelding 2 mag maximaal 2MB zijn.',
            'image_3.image' => 'Afbeelding 3 moet een afbeelding zijn.',
            'image_3.mimes' => 'Afbeelding 3 moet jpeg, png, jpg, gif of svg zijn.',
            'image_3.max' => 'Afbeelding 3 mag maximaal 2MB zijn.',
            'image_4.image' => 'Afbeelding 4 moet een afbeelding zijn.',
            'image_4.mimes' => 'Afbeelding 4 moet jpeg, png, jpg, gif of svg zijn.',
            'image_4.max' => 'Afbeelding 4 mag maximaal 2MB zijn.',
        ];
    }
}

