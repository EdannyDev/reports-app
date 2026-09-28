<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Mail\NewReportNotification;
use App\Models\Report;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    /**
     * Lista de reportes, paginada y filtrable por texto libre.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        /** @var LengthAwarePaginator $reports */
        $reports = Report::with(['area', 'user'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('area', fn ($q) => $q->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(5);

        $reports->withQueryString();

        return view('reports.index', compact('reports', 'search'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('reports.create', compact('areas'));
    }

    // Validación delegada a StoreReportRequest.
    public function store(StoreReportRequest $request)
    {
        $report = Report::create([
            ...$request->validated(),
            'status' => 'pendiente',
            'user_id' => Auth::id(),
        ]);

        $adminEmails = User::where('role', 'admin')->pluck('email');

        if ($adminEmails->isNotEmpty()) {
            Mail::to($adminEmails)->send(new NewReportNotification($report));
        }

        return redirect()->route('reports.index')->with('success', 'Reporte creado exitosamente.');
    }

    public function show($id)
    {
        $report = Report::with(['area', 'user'])->findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);

        $this->authorize('update', $report);

        $areas = Area::all();
        $statuses = ['pendiente', 'cancelado', 'completado'];

        return view('reports.edit', compact('report', 'areas', 'statuses'));
    }

    // Validación delegada a UpdateReportRequest.
    public function update(UpdateReportRequest $request, $id)
    {
        $report = Report::findOrFail($id);

        $this->authorize('update', $report);

        $report->update($request->validated());

        return redirect()->route('reports.index')->with('success', 'Reporte actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        $this->authorize('delete', $report);

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Reporte eliminado exitosamente.');
    }
}