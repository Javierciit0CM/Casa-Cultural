<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Registra los comandos personalizados de la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands'); // Carga los comandos en la carpeta Console/Commands

        require base_path('routes/console.php'); // Asegura que Laravel pueda registrar rutas de consola
    }

    /**
     * Define la programación de tareas.
     */
    protected function schedule(Schedule $schedule)
    {
        // Programa el comando para que se ejecute todos los días a las 13:00
        $schedule->command('reservations:check-expired')->dailyAt('13:00');
        $schedule->command('reservations:check-notifications')->everyMinute();
    }
}
