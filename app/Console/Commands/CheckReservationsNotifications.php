<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use Carbon\Carbon;

class CheckReservationsNotifications extends Command
{
    protected $signature = 'reservations:check-notifications';
    protected $description = 'Muestra notificaciones de nuevas reservas y las que están por vencerse';

    public function handle()
    {
        // Notificación de nuevas reservas
        $nuevasReservas = Reserva::where('estado', 'Pendiente')->get();
        foreach ($nuevasReservas as $reserva) {
            $this->notifyNewReservation($reserva);
        }

        // Notificación de reservas a 30 minutos de su fecha de entrada
        $this->notifyUpcomingReservations();
    }

    private function notifyNewReservation($reserva)
    {
        // Aquí se muestra la notificación de nueva reserva (puedes agregarla a una tabla de notificaciones si lo deseas)
        $this->info('Nueva reserva para la habitación ' . $reserva->habitacion_id);
    }

    private function notifyUpcomingReservations()
    {
        $now = Carbon::now();
        $reservasPorVencer = Reserva::where('fecha_entrada', '<', $now->addMinutes(30)->toDateTimeString())
                                      ->where('estado', 'Confirmada') // Aseguramos que sea una reserva confirmada
                                      ->get();

        foreach ($reservasPorVencer as $reserva) {
            $this->info('La reserva de la habitación ' . $reserva->habitacion_id . ' está por vencerse en 30 minutos');
        }
    }
}
