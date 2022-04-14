<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'cost_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'quantity_min' => 'nullable|integer',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute não é uma string.',
            'numeric' => 'O campo :attribute não é um número.',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nome',
            'description' => 'Descrição',
            'price' => 'Preço',
            'cost_price' => 'Preço de custo',
            'quantity' => 'Quantidade',
            'quantity_min' => 'Quantidade miníma',
        ];
    }
}
