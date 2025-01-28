<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacione;
use App\Models\Cliente;
use Illuminate\Http\Request;


class ReservaController extends Controller
{
    public function index() {
        $reservas = Reserva::all();
        return view('reservas.index', compact('reservas'));
    }

    public function create() {
        $habitaciones = Habitacione::all(); // Obtener todas las habitaciones
        $clientes = Cliente::all();       // Obtener todos los clientes
        return view('reservas.create', compact('habitaciones', 'clientes'));
    }

    public function store(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $validatedData = $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'estado' => 'required|in:Pendiente,Confirmada,Cancelada',
        ]);

        // Calcular los días de estadía
        $fechaEntrada = new \DateTime($validatedData['fecha_entrada']);
        $fechaSalida = new \DateTime($validatedData['fecha_salida']);
        $diasEstadia = $fechaEntrada->diff($fechaSalida)->days;

        // Obtener el precio de la habitación seleccionada
        $habitacion = Habitacione::find($validatedData['habitacion_id']);
        $costoTotal = $diasEstadia * $habitacion->precio;

        // Crear la reserva en la base de datos
        $reserva = Reserva::create([
            'habitacion_id' => $validatedData['habitacion_id'],
            'cliente_id' => $validatedData['cliente_id'],
            'fecha_entrada' => $validatedData['fecha_entrada'],
            'fecha_salida' => $validatedData['fecha_salida'],
            'dias_estadia' => $diasEstadia,
            'costo' => $costoTotal,
            'estado' => $validatedData['estado'],
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('reservas.index')
            ->with('success', '¡Reserva registrada exitosamente!');
    }

    public function destroy($id)
    {
        // Buscar la reserva por su ID
        $reserva = Reserva::find($id);
    
        // Verificar si la reserva existe
        if (!$reserva) {
            return redirect()->route('reservas.index')->with('error', 'La reserva no existe o ya ha sido eliminada.');
        }
    
        // Eliminar la reserva
        $reserva->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $validated = $request->validate([
            'estado' => 'required|in:Pendiente,Confirmada,Cancelada', // Aseguramos que el estado sea uno de los válidos
        ]);

        // Encontrar la reserva
        $reserva = Reserva::findOrFail($id);

        // Actualizar el estado de la reserva
        $reserva->estado = $request->estado;
        $reserva->save();

        // Obtener la habitación asociada a la reserva
        $habitacion = Habitacione::findOrFail($reserva->habitacion_id);

        // Cambiar el estado de la habitación dependiendo del estado de la reserva
        if ($request->estado == 'Confirmada') {
            $habitacion->estado = 'ocupado';
        } elseif ($request->estado == 'Cancelada') {
            $habitacion->estado = 'disponible';
        } elseif ($request->estado == 'Pendiente') {
            $habitacion->estado = 'reservado';
        }

        // Guardar el cambio en la habitación
        $habitacion->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente');
    }

}
