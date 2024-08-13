<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable',
            'banner' => 'nullable',
            'banner.*' => 'nullable',
            'phone' => 'required|string|min:12',
            'address' => 'nullable|string',
            'map' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'x' => 'nullable|string',
            'email' => 'nullable|string|unique:settings,email|email',
            'website' => 'nullable|string',
        ];
    }


}
