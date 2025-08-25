<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $vehicleId = $this->route('id');

        return [
            'type' => 'sometimes|required|string|max:50',
            'brand' => 'sometimes|required|string|max:100',
            'model' => 'sometimes|required|string|max:100',
            'category' => 'sometimes|required|string|max:100',
            'fuel' => 'sometimes|required|string|max:50',
            'year_model' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'year_build' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'sometimes|required|numeric|min:0',
            'transmission' => 'sometimes|required|string|max:50',
            'color' => 'sometimes|required|string|max:50',
            'board' => [
                'sometimes',
                'required',
                'string',
                'max:10',
                Rule::unique('vehicles')->ignore($vehicleId)
            ],
            'chassi' => [
                'sometimes',
                'required',
                'string',
                'max:30',
                Rule::unique('vehicles')->ignore($vehicleId)
            ],
            'description' => 'nullable|string',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|string|max:100',
            'fotos' => 'nullable|array',
            'fotos.*' => 'nullable|url',
            'sold' => 'sometimes|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'O tipo do veículo é obrigatório.',

            'brand.required' => 'A marca é obrigatória.', 

            'model.required' => 'O modelo é obrigatório.',

            'category.required' => 'A categoria é obrigatória.',

            'fuel.required' => 'O combustível é obrigatório.',

            'year_model.required' => 'O ano do modelo é obrigatório.',
            'year_build.required' => 'O ano de fabricação é obrigatório.',

            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser numérico.',

            'transmission.required' => 'A transmissão é obrigatória.',

            'color.required' => 'A cor é obrigatória.',

            'board.required' => 'A placa é obrigatória.',
            'board.unique' => 'Já existe outro veículo com esta placa.',

            'chassi.required' => 'O chassi é obrigatório.',
            'chassi.unique' => 'Já existe outro veículo com este chassi.',

            'description.string' => 'A descrição deve ser um texto.',

            'optionals.array' => 'Os opcionais devem ser uma lista.',

            'optionals.*.string' => 'Cada opcional deve ser um texto.',

            'optionals.*.max' => 'Cada opcional não pode ter mais que 100 caracteres.',

            'fotos.array' => 'As fotos devem ser uma lista.',
            'fotos.*.url' => 'Cada foto deve ser uma URL válida.',
            
            'sold.boolean' => 'O campo vendido deve ser verdadeiro ou falso.'
        ];
    }
}
