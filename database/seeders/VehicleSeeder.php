<?php

namespace Database\Seeders;

use App\Services\VehicleService;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = VehicleService::getVehicles();

        foreach ($vehicles as $data) {
            Vehicle::create([
                'type' => $data['type'],
                'brand' => $data['brand'],
                'model' => $data['model'],
                'version' => $data['version'],
                'year_model' => $data['year_model'],
                'year_build' => $data['year_build'],
                'category' => $data['category'],
                'fuel' => $data['fuel'],
                'transmission' => $data['transmission'],
                'price' => $data['price'],
                'color' => $data['color'],
                'board' => $data['board'],
                'chassi' => $data['chassi'],
                'km' => $data['km'],
                'description' => $data['description'],
                'optionals' => $data['optionals'],
                'fotos' => $data['fotos'],
                'sold' => $data['sold'],
            ]);
        }
    }
}
