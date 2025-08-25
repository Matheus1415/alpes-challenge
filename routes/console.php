<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

$schedule = app(Schedule::class);

$timezone = env('APP_TIMEZONE', 'America/Fortaleza');

$schedule->command('vehicles:dispatch-job')
    ->hourly()
    ->timezone($timezone);