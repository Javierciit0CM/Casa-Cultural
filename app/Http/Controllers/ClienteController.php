<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index() {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:clientes',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'procedencia' => 'required',
            'condicion' => 'required',
        ]);
    
        Cliente::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'edad' => $request->edad,
            'procedencia' => $request->procedencia,
            'condicion' => $request->condicion,
        ]);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'dni' => 'required|string|max:8', // Puedes ajustar según las reglas de tu DNI
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'edad' => 'required|integer|min:0|max:150',
            'procedencia' => 'required|string|max:255',
            'condicion' => 'required|string|max:255',
        ]);

        // Buscar el cliente por su ID
        $cliente = Cliente::findOrFail($id);

        // Actualizar los datos del cliente
        $cliente->dni = $request->input('dni');
        $cliente->nombre = $request->input('nombre');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->telefono = $request->input('telefono');
        $cliente->edad = $request->input('edad');
        $cliente->procedencia = $request->input('procedencia');
        $cliente->condicion = $request->input('condicion');

        // Guardar los cambios
        $cliente->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }


    public function destroy($id) {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
