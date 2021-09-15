<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => ['sometimes', 'required', 'string', 'max:100'],
            'description' => ['sometimes', 'required', 'string', 'max:500'],
            'price' => ['sometimes', 'required', 'regex:/^\d+(\.\d{1,2})?$/'], // Regex allowed values: 12, 12.5 or 12.05
            'quantity' => ['sometimes', 'required', 'integer'],
        ];
    }
}
