<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'pharmacies' => ['sometimes', 'required', 'array'],
            'pharmacies.*.pharmacy_id' => ['required_with:pharmacies', 'integer', 'exists:pharmacies,id', 'distinct'],
            'pharmacies.*.price' => ['required_with:pharmacies', 'regex:/^\d+(\.\d{1,2})?$/'], // Allowed values format: 12, 12.5 or 12.05
            'pharmacies.*.quantity' => ['required_with:pharmacies', 'integer', 'max:1000'],
        ];
    }
}
