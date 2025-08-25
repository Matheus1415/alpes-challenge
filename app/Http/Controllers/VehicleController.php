<?php

namespace App\Http\Controllers;

// Models
use App\Models\Vehicle;

// Request
use App\Http\Requests\StoreVehicleRequest;

// Libs
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index()
    {
        //
    }

    public function store(StoreVehicleRequest $request)
    {
        try {
            $data = $request->validated();

            $duplicate = Vehicle::where('board', $data['board'] ?? null)
                ->orWhere('chassi', $data['chassi'] ?? null)
                ->first();

            if ($duplicate) {
                return response()->json([
                    'message' => 'Já existe um veículo cadastrado com esta placa ou chassi.',
                    'duplicate' => $duplicate
                ], 409);
            }

            $car = Vehicle::create($data);

            return response()->json([
                'message' => 'Veículo cadastrado com sucesso!',
                'data' => $car
            ], 201);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Erro interno ao cadastrar o veículo.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function show(Vehicle $vehicle)
    {
        //
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
