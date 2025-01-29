<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use App\Models\Habitacione;
use Carbon\Carbon;

class CheckReservationsExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reservations and update their status and the room status at 13:00 daily';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Obtén la fecha y hora actual
        $now = Carbon::now();

        // Asegúrate de que la hora sea exactamente las 13:00
        if ($now->hour == 13 && $now->minute == 0) {
            // Obtén las reservas cuya fecha de salida ya haya pasado
            $reservasExpiradas = Reserva::where('fecha_salida', '<', $now->toDateString())
                ->where('estado', 'Confirmada') // Solo aquellas con estado confirmado
                ->get();

            foreach ($reservasExpiradas as $reserva) {
                // Cambiar el estado de la reserva a "Finalizada"
                $reserva->estado = 'Finalizada';
                $reserva->save();

                // Actualizar la habitación asociada a la reserva
                $habitacion = Habitacione::find($reserva->habitacion_id);
                if ($habitacion) {
                    $habitacion->estado = 'Disponible'; // Cambiar el estado de la habitación
                    $habitacion->save();
                }

                // Mostrar mensaje en consola
                $this->info('Reserva ' . $reserva->id . ' actualizada a "Finalizada" y habitación cambiada a "Disponible".');
            }
        } else {
            $this->info('No es hora de actualizar las reservas. La actualización solo ocurre a las 13:00.');
        }
    }
}
