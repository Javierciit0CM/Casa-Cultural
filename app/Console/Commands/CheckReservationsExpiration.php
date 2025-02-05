<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use App\Models\Habitacione; // Asegurar que el modelo esté bien nombrado
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
    protected $description = 'Check reservations and update their status and the room status daily at 13:00';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Obtener reservas expiradas
        $reservasExpiradas = Reserva::where('fecha_salida', '<=', $now)
            ->where('estado', 'Confirmada') // Solo reservas confirmadas
            ->get();

        foreach ($reservasExpiradas as $reserva) {
            // Marcar reserva como finalizada
            $reserva->update(['estado' => 'Finalizada']);

            // Liberar la habitación
            $habitacion = Habitacion::find($reserva->habitacion_id);
            if ($habitacion) {
                $habitacion->update(['estado' => 'Disponible']);
            }

            $this->info("Reserva ID {$reserva->id} finalizada y habitación marcada como disponible.");
        }
    }
}
