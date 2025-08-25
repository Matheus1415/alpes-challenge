<?php

namespace App\Jobs;

use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateVehiclesFromJson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $vehicles = VehicleService::getVehicles();

        foreach ($vehicles as $data) {
            Vehicle::updateOrCreate(
                ['board' => $data['board'], 'chassi' => $data['chassi']],
                $data
            );
        }
    }
}
