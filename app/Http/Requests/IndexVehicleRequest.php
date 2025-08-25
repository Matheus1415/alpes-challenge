<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir o acesso
    }
    
    public function rules(): array
    {
        return [
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'fuel' => 'nullable|string|max:50',
            'year_model' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
            'transmission' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'sold' => 'nullable|boolean',
            'board' => 'nullable|string|max:10',
            'chassi' => 'nullable|string|max:30',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|string|max:100',
            'sort' => 'nullable|string|in:id,brand,model,year_model,price,created_at',
            'direction' => 'nullable|string|in:asc,desc',
        ];
    }

    public function messages(): array
    {
        return [
            'brand.string' => 'A marca deve ser um texto.',
            'brand.max' => 'A marca não pode ter mais que 100 caracteres.',
            'model.string' => 'O modelo deve ser um texto.',
            'model.max' => 'O modelo não pode ter mais que 100 caracteres.',
            'category.string' => 'A categoria deve ser um texto.',
            'category.max' => 'A categoria não pode ter mais que 100 caracteres.',
            'fuel.string' => 'O combustível deve ser um texto.',
            'fuel.max' => 'O combustível não pode ter mais que 50 caracteres.',
            'year_model.integer' => 'O ano do modelo deve ser um número inteiro.',
            'year_model.min' => 'O ano do modelo não pode ser menor que 1900.',
            'year_model.max' => 'O ano do modelo não pode ser maior que o próximo ano.',
            'price_min.numeric' => 'O preço mínimo deve ser um número.',
            'price_min.min' => 'O preço mínimo não pode ser negativo.',
            'price_max.numeric' => 'O preço máximo deve ser um número.',
            'price_max.min' => 'O preço máximo não pode ser negativo.',
            'transmission.string' => 'A transmissão deve ser um texto.',
            'transmission.max' => 'A transmissão não pode ter mais que 50 caracteres.',
            'color.string' => 'A cor deve ser um texto.',
            'color.max' => 'A cor não pode ter mais que 50 caracteres.',
            'sold.boolean' => 'O campo vendido deve ser verdadeiro ou falso.',
            'board.string' => 'A placa deve ser um texto.',
            'board.max' => 'A placa não pode ter mais que 10 caracteres.',
            'chassi.string' => 'O chassi deve ser um texto.',
            'chassi.max' => 'O chassi não pode ter mais que 30 caracteres.',
            'optionals.array' => 'Os opcionais devem ser uma lista.',
            'optionals.*.string' => 'Cada opcional deve ser um texto.',
            'optionals.*.max' => 'Cada opcional não pode ter mais que 100 caracteres.',
            'sort.in' => 'O campo de ordenação deve ser: id, brand, model, year_model, price ou created_at.',
            'direction.in' => 'A direção da ordenação deve ser asc ou desc.',
        ];
    }
}
