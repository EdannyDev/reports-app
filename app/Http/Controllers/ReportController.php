<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Mostrar la lista de reportes.
     */
    public function index()
    {
        $reports = Report::with(['area', 'user'])->get();
        return view('reports.index', compact('reports'));
    }

    /**
     * Mostrar el formulario de creación de un nuevo reporte.
     */
    public function create()
    {
        $areas = Area::all(); // Obtener las áreas disponibles.
        return view('reports.create', compact('areas'));
    }

    /**
     * Almacenar un nuevo reporte en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos enviados en la creación del reporte.
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'area_id' => 'required|exists:areas,id',
        ]);

        // Crear el reporte con los datos validados.
        Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'pendiente', // Establecer un estado predeterminado
            'area_id' => $request->area_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Reporte creado exitosamente.');
    }

    /**
     * Mostrar los detalles de un reporte.
     */
    public function show($id)
    {
        $report = Report::with(['area', 'user'])->findOrFail($id);
        return view('reports.show', compact('report'));
    }

    /**
     * Mostrar el formulario de edición de un reporte existente.
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);

        // Puedes agregar una verificación de permisos si lo deseas:
        /* if ($report->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para realizar esta acción.');
        } */

        $areas = Area::all();
        $statuses = ['pendiente', 'cancelado', 'completado'];

        return view('reports.edit', compact('report', 'areas', 'statuses'));
    }

    /**
     * Actualizar un reporte existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos enviados en la actualización del reporte.
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'area_id' => 'required|exists:areas,id',
            'status' => 'required|string|in:pendiente,cancelado,completado',
        ]);

        $report = Report::findOrFail($id);

        // Puedes agregar una verificación de permisos si lo deseas:
        /* if ($report->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para realizar esta acción.');
        } */

        // Actualizamos el reporte con los datos validados.
        $report->update([
            'title' => $request->title,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'area_id' => $request->area_id,
        ]);

        return redirect()->route('reports.index')->with('success', 'Reporte actualizado exitosamente.');
    }

    /**
     * Eliminar un reporte de la base de datos.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Puedes agregar una verificación de permisos si lo deseas:
        /* if ($report->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para realizar esta acción.');
        } */

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Reporte eliminado exitosamente.');
    }
}