<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'material_id' => 'required|exists:materials,id',
            'unit_id' => 'required|exists:units,id',
            'model_number' => 'nullable|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'cover' => 'nullable',
            'stock' => 'required|integer',
            'colors.*' => 'required|exists:colors,id',
            'sizes.*' => 'required|exists:sizes,id',
            'images.*' => 'nullable|file|mimes:jpg,png|max:2048',
            'type' => 'required|string',
            'size' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ];

        if ($this->isMethod('post')) {
            $rules['slug'] = 'required|string|unique:products,slug';
        } elseif ($this->isMethod('patch')) {
            $rules['slug'] = 'required|string|unique:products,slug,' . $this->product->id;
        }

        return $rules;
    }
}
