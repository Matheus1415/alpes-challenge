<?php

namespace App\Http\Controllers;

// Models
use App\Models\Vehicle;

// Request
use App\Http\Requests\IndexVehicleRequest;
use App\Http\Requests\StoreVehicleRequest;

class VehicleController extends Controller
{

    public function index(IndexVehicleRequest $request)
    {
        try {
            $vehicles = Vehicle::query()
                ->when(!empty($request->brand), function ($query) use ($request) {
                    $query->where('brand', 'like', '%' . $request->brand . '%');
                })
                ->when(!empty($request->model), function ($query) use ($request) {
                    $query->where('model', 'like', '%' . $request->model . '%');
                })
                ->when(!empty($request->category), function ($query) use ($request) {
                    $query->where('category', $request->category);
                })
                ->when(!empty($request->fuel), function ($query) use ($request) {
                    $query->where('fuel', $request->fuel);
                })
                ->when(!empty($request->year_model), function ($query) use ($request) {
                    $query->where('year_model', $request->year_model);
                })
                ->when(!empty($request->price_min), function ($query) use ($request) {
                    $query->where('price', '>=', $request->price_min);
                })
                ->when(!empty($request->price_max), function ($query) use ($request) {
                    $query->where('price', '<=', $request->price_max);
                })
                ->when(!empty($request->transmission), function ($query) use ($request) {
                    $query->where('transmission', $request->transmission);
                })
                ->when(!empty($request->color), function ($query) use ($request) {
                    $query->where('color', 'like', '%' . $request->color . '%');
                })
                ->when(isset($request->sold), function ($query) use ($request) {
                    $query->where('sold', (bool) $request->sold);
                })
                ->when(!empty($request->board), function ($query) use ($request) {
                    $query->where('board', 'like', '%' . $request->board . '%');
                })
                ->when(!empty($request->chassi), function ($query) use ($request) {
                    $query->where('chassi', 'like', '%' . $request->chassi . '%');
                })
                ->when(!empty($request->optionals), function ($query) use ($request) {
                    $query->whereJsonContains('optionals', $request->optionals);
                })
                ->orderBy($request->get('sort', 'created_at'), $request->get('direction', 'desc'))
                ->get();

            return response()->json([
                'message' => 'Lista de veículos recuperada com sucesso!',
                'data' => $vehicles
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Erro interno ao listar os veículos.',
                'error' => $error->getMessage()
            ], 500);
        }
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
