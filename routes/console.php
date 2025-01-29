<?php

use App\Console\Commands\CheckReservationsExpiration;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:check-reservations-expiration', function () {
    $this->comment('Check for expired reservations');
})->hourly();
