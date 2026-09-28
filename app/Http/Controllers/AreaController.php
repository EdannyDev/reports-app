<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use Illuminate\Database\QueryException;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(StoreAreaRequest $request)
    {
        Area::create($request->validated());

        return redirect()->route('areas.index')->with('success', 'Área creada correctamente.');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    public function update(UpdateAreaRequest $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->validated());

        return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);

        try {
            $area->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'No se puede eliminar un área que tiene reportes asociados.');
        }

        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }
}