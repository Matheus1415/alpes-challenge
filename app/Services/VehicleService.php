<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class VehicleService
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

    /**
     * Retorna os veículos da API ou fallback se não existir, sanitizando os campos de texto.
     *
     * @return array
     */
    public static function getVehicles(): array
    {
        $url = 'https://hub.alpes.one/api/v1/integrator/export/1902';

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful() && !empty($response->json())) {
                $vehicles = $response->json();
                return array_map([self::class, 'sanitizeVehicle'], $vehicles);
            }

        } catch (\Exception $e) {}

        $localPath = resource_path('json/vehicles.json');

        if (File::exists($localPath)) {
            $vehicles = json_decode(File::get($localPath), true);
            if (!empty($vehicles)) {
                return array_map([self::class, 'sanitizeVehicle'], $vehicles);
            }
        }

        return [
            self::sanitizeVehicle([
                'type' => 'carro',
                'brand' => 'Hyundai',
                'model' => 'CRETA',
                'version' => 'CRETA 16A ACTION',
                'year' => ['model' => 2025, 'build' => 2025],
                'category' => 'SUV',
                'fuel' => 'Gasolina',
                'transmission' => 'Automática',
                'price' => 115900.00,
                'color' => 'Branco',
                'board' => 'JCU2I93',
                'chassi' => '9BWZZZ377VT004251',
                'km' => 24208,
                'description' => "*revisado\r\n*procedência\r\n*garantia \r\nPegamos trocas mediante avaliação.",
                'optionals' => ['Ar-condicionado', 'Vidro elétrico', 'Central multimídia'],
                'fotos' => [
                    "https://alpes-hub.s3.amazonaws.com/uploads/public/67c/0b5/8c9/67c0b58c91b8f637846682.jpeg",
                    "https://alpes-hub.s3.amazonaws.com/uploads/public/67c/0b5/a90/67c0b5a9067ff421616405.jpeg",
                ],
                'sold' => false
            ])
        ];
    }
}
