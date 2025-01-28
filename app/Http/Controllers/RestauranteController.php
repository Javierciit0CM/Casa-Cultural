<?php

namespace App\Http\Controllers;

use App\Models\ImagenRestaurante;
use App\Models\Restaurante;

use Illuminate\Http\Request;


class RestauranteController extends Controller
{
    public function index() {
        $restaurantes = Restaurante::all();
        return view('restaurante.index', compact('restaurantes'));
    }
    public function create() {
        return view('restaurante.create');
    }

    public function store(Request $request)
{
    // Validar los campos del formulario
    $request->validate([
        'tipo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'disponibilidad' => 'required|boolean',
        'imagenes' => 'required|array',
        'imagenes.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Crear el registro del restaurante
    $restaurante = Restaurante::create([
        'tipo' => $request->tipo,
        'nombre' => $request->nombre,
        'precio' => $request->precio,
        'disponibilidad' => $request->disponibilidad,
    ]);

    // Subir y registrar las imágenes
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $ruta = $imagen->store('imagenes_restaurante', 'public');
            ImagenRestaurante::create([
                'restaurante_id' => $restaurante->id,
                'ruta_imagen' => $ruta,
            ]);
        }
    }

    // Redireccionar con éxito
    return redirect()->route('restaurante.index')->with('success', 'Restaurante registrado correctamente.');
}


    public function destroy($id) {
        // Buscar el restaurante por su ID
        $restaurante = Restaurante::find($id);

        // Verificar si el restaurante existe antes de intentar eliminarlo
        if ($restaurante) {
            $restaurante->delete();
            return redirect()->route('restaurante.index')->with('success', 'Restaurante eliminado exitosamente.');
        } else {
            return redirect()->route('restaurante.index')->with('error', 'Restaurante no encontrado.');
        }
    }

    public function show($id) {
        $restaurante =  Restaurante::find($id);
        return view('restaurante.view', compact('restaurante'));
    }

    public function edit($id) {
        $restaurante = Restaurante::find($id);
        return view('restaurante.edit', compact('restaurante'));
    }

    public function update(Request $request, $id) {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'tipo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'disponibilidad' => 'required|boolean',
        ]);

        // Buscar el restaurante por su ID
        $restaurante = Restaurante::find($id);

        // Actualizar los datos del restaurante
        $restaurante->update([
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'disponibilidad' => $request->disponibilidad,
        ]);

        // Redireccionar con éxito
        return redirect()->route('restaurante.index')->with('success', 'Restaurante actualizado correctamente.');
    }

}
