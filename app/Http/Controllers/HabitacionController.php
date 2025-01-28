<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacione;
use App\Models\Imagenes;

class HabitacionController extends Controller
{  
    public function index() {
        $habitaciones = Habitacione::all();
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function create() {
        return view ('habitaciones.create');
    }

    public function store(Request $request)
        {
            // Validación de los campos
            $request->validate([
                'img' => 'required|array',
                'img.*' => 'image|mimes:jpg,jpeg,png,gif',
                'tipo_habitacion' => 'required|string|max:255',
                'capacidad_maxima' => 'required|string|max:255',
                'precio' => 'required|numeric|min:0',
                'numero_habitacion' => 'required|numeric|min:0',
                'descripcion' => 'required|string',
            ]);

            try {
                // Crear un nuevo registro de habitación
                $habitacion = Habitacione::create([
                    'tipo_habitacion' => $request->tipo_habitacion,
                    'capacidad_maxima' => $request->capacidad_maxima,
                    'precio' => $request->precio,
                    'numero_habitacion' => $request->numero_habitacion,
                    'descripcion' => $request->descripcion,
                ]);

                // Subir las imágenes y guardarlas en la base de datos
                if ($request->hasFile('img')) {
                    foreach ($request->file('img') as $imagen) {
                        // Subir la imagen al almacenamiento
                        $imagePath = $imagen->store('imagenes_habitaciones', 'public');

                        // Crear una nueva entrada en la tabla imagenes
                        Imagenes::create([
                            'id_habitaciones' => $habitacion->id,
                            'img' => $imagePath,
                            'tipo_habitacion' => $request->tipo_habitacion,
                            'capacidad_maxima' => $request->capacidad_maxima,
                            'precio' => $request->precio,
                            'descripcion' => $request->descripcion,
                            'numero_habitacion' => $request->numero_habitacion
                        ]);
                    }

                    return redirect()->route('habitaciones.index')
                                ->with('success', 'La habitación y sus imágenes se han registrado correctamente.');
                }

                return back()->withErrors(['img' => 'Por favor seleccione imágenes para cargar.']);

            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Ocurrió un error al guardar los datos: ' . $e->getMessage()])
                            ->withInput();
            }
        }

    public function show($id) { 
        $habitacion = Habitacione::find($id);
        return view('habitaciones.show', compact('habitacion'));
    }


    public function edit($id)
    {
        // Obtener la habitación con sus imágenes relacionadas
        $habitaciones = Habitacione::with('imagenes')->findOrFail($id);

        return view('habitaciones.edit', compact('habitaciones'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'img' => 'array',
            'img.*' => 'image|mimes:jpg,jpeg,png,gif',
            'tipo_habitacion' => 'required|string|max:255',
            'capacidad_maxima' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'numero_habitacion' => 'required|numeric|min:0',
            'descripcion' => 'required|string',
        ]);

        try {
            // Actualizar la habitación
            $habitacion = Habitacione::findOrFail($id);
            $habitacion->update([
                'tipo_habitacion' => $request->tipo_habitacion,
                'capacidad_maxima' => $request->capacidad_maxima,
                'precio' => $request->precio,
                'numero_habitacion' => $request->numero_habitacion,
                'descripcion' => $request->descripcion,
            ]);

            // Subir las imágenes y guardarlas en la base de datos
            if ($request->hasFile('img')) {
                foreach ($request->file('img') as $imagen) {
                    // Subir la imagen al almacenamiento
                    $imagePath = $imagen->store('imagenes_habitaciones', 'public');

                    // Crear una nueva entrada en la tabla imagenes
                    Imagenes::create([
                        'id_habitaciones' => $habitacion->id,
                        'img' => $imagePath,
                        'tipo_habitacion' => $request->tipo_habitacion,
                        'capacidad_maxima' => $request->capacidad_maxima,
                        'precio' => $request->precio,
                        'descripcion' => $request->descripcion,
                        'numero_habitacion' => $request->numero_habitacion
                    ]);
                }

                return redirect()->route('habitaciones.index')
                            ->with('success', 'La habitación y sus imágenes se han actualizado correctamente.');
            }

            return back()->withErrors(['img' => 'Por favor seleccione imágenes para cargar.']);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrio un error al actualizar los datos: ' . $e->getMessage()])
                        ->withInput();
        }
    }

    public function destroy($id) {
        $habitacion = Habitacione::find($id);
        $habitacion->delete();
        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada exitosamente.');
    }
}
