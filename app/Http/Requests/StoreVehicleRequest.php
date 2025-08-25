<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|max:50',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'version' => 'nullable|string|max:150',
            'year_model' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'year_build' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'optionals' => 'nullable|array',
            'doors' => 'nullable|integer|min:2|max:6',
            'board' => 'nullable|string|max:10',
            'chassi' => 'nullable|string|max:30',
            'transmission' => 'nullable|string|max:50',
            'km' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'sold' => 'boolean',
            'category' => 'nullable|string|max:100',
            'url_car' => 'nullable|string|max:255',
            'old_price' => 'nullable|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:50',
            'fuel' => 'nullable|string|max:50',
            'fotos' => 'nullable|array',
            'fotos.*' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'O tipo do veículo é obrigatório.',
            'type.string' => 'O tipo do veículo deve ser um texto.',
            'type.max' => 'O tipo do veículo não pode ter mais que 50 caracteres.',

            'brand.required' => 'A marca é obrigatória.',
            'brand.string' => 'A marca deve ser um texto.',
            'brand.max' => 'A marca não pode ter mais que 100 caracteres.',

            'model.required' => 'O modelo é obrigatório.',
            'model.string' => 'O modelo deve ser um texto.',
            'model.max' => 'O modelo não pode ter mais que 100 caracteres.',

            'version.string' => 'A versão deve ser um texto.',
            'version.max' => 'A versão não pode ter mais que 150 caracteres.',

            'year_model.required' => 'O ano do modelo é obrigatório.',
            'year_model.integer' => 'O ano do modelo deve ser um número inteiro.',
            'year_model.min' => 'O ano do modelo deve ser no mínimo 1900.',
            'year_model.max' => 'O ano do modelo não pode ultrapassar o próximo ano.',

            'year_build.required' => 'O ano de fabricação é obrigatório.',
            'year_build.integer' => 'O ano de fabricação deve ser um número inteiro.',
            'year_build.min' => 'O ano de fabricação deve ser no mínimo 1900.',
            'year_build.max' => 'O ano de fabricação não pode ultrapassar o próximo ano.',

            'optionals.array' => 'Os opcionais devem estar em formato de lista.',

            'doors.integer' => 'A quantidade de portas deve ser um número inteiro.',
            'doors.min' => 'O veículo deve ter no mínimo 2 portas.',
            'doors.max' => 'O veículo não pode ter mais que 6 portas.',

            'board.string' => 'A placa deve ser um texto.',
            'board.max' => 'A placa não pode ter mais que 10 caracteres.',

            'chassi.string' => 'O chassi deve ser um texto.',
            'chassi.max' => 'O chassi não pode ter mais que 30 caracteres.',

            'transmission.string' => 'A transmissão deve ser um texto.',
            'transmission.max' => 'A transmissão não pode ter mais que 50 caracteres.',

            'km.integer' => 'A quilometragem deve ser um número inteiro.',
            'km.min' => 'A quilometragem não pode ser negativa.',

            'description.string' => 'A descrição deve ser um texto.',

            'sold.boolean' => 'O campo vendido deve ser verdadeiro ou falso.',

            'category.string' => 'A categoria deve ser um texto.',
            'category.max' => 'A categoria não pode ter mais que 100 caracteres.',

            'url_car.string' => 'A URL do veículo deve ser um texto.',
            'url_car.max' => 'A URL do veículo não pode ter mais que 255 caracteres.',

            'old_price.numeric' => 'O preço antigo deve ser um valor numérico.',
            'old_price.min' => 'O preço antigo não pode ser negativo.',

            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um valor numérico.',
            'price.min' => 'O preço não pode ser negativo.',

            'color.string' => 'A cor deve ser um texto.',
            'color.max' => 'A cor não pode ter mais que 50 caracteres.',

            'fuel.string' => 'O combustível deve ser um texto.',
            'fuel.max' => 'O combustível não pode ter mais que 50 caracteres.',

            'fotos.array' => 'As fotos devem estar em formato de lista.',
            'fotos.*.url' => 'Cada foto deve ser uma URL válida.',
        ];
    }

}
