<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Muestra todas las áreas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $areas = Area::all();  // Obtiene todas las áreas
        return view('areas.index', compact('areas'));  // Muestra la lista de áreas
    }

    /**
     * Muestra el formulario para crear una nueva área.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('areas.create');  // Muestra el formulario de creación de áreas
    }

    /**
     * Guarda una nueva área en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de los datos de la nueva área
        $request->validate([
            'name' => 'required|string|unique:areas|max:255',
        ]);

        // Crear la nueva área
        Area::create([
            'name' => $request->name,
        ]);

        // Redirige a la lista de áreas
        return redirect()->route('areas.index');
    }

    /**
     * Muestra el formulario para editar una área.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);  // Encuentra la área por ID
        return view('areas.edit', compact('area'));  // Muestra el formulario de edición
    }

    /**
     * Actualiza una área existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos de la área
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Encuentra la área y actualízala
        $area = Area::findOrFail($id);
        $area->update([
            'name' => $request->name,
        ]);

        // Redirige a la lista de áreas
        return redirect()->route('areas.index');
    }

    /**
     * Elimina una área.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();  // Elimina la área

        return redirect()->route('areas.index');  // Redirige a la lista de áreas
    }
}
