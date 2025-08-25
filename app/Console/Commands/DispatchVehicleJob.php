<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\UpdateVehiclesFromJson;

class DispatchVehicleJob extends Command
{
    protected $signature = 'vehicles:dispatch-job';
    protected $description = 'Dispara o Job que atualiza veículos a partir do JSON';

    public function handle(): void
    {
        UpdateVehiclesFromJson::dispatch();
        $this->info('Job disparado com sucesso!');
    }
}
