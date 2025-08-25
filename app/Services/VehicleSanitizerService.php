<?php

namespace App\Services;

class VehicleSanitizerService
{
    /**
     * Sanitiza os campos de texto de um veículo.
     *
     * @param array $data
     * @return array
     */
    public static function sanitize(array $data): array
    {
        $fields = [
            'brand',
            'model',
            'category',
            'fuel',
            'transmission',
            'color',
            'board',
            'chassi',
            'description'
        ];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $data[$field] = strip_tags($data[$field]);
            }
        }

        if (isset($data['optionals']) && is_array($data['optionals'])) {
            $data['optionals'] = array_map(fn($item) => strip_tags($item), $data['optionals']);
        }

        if (isset($data['fotos']) && is_array($data['fotos'])) {
            $data['fotos'] = array_map(fn($item) => strip_tags($item), $data['fotos']);
        }

        return $data;
    }
}
