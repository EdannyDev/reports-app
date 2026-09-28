@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg rounded" style="max-width: 600px; width: 100%; background-color: #f8f9fa;">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detalle del Reporte</h4>
            <span class="badge bg-{{ $report->status === 'completado' ? 'success' : ($report->status === 'pendiente' ? 'warning' : 'danger') }}">
                {{ ucfirst($report->status) }}
            </span>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Título</dt>
                <dd class="col-sm-8">{{ $report->title }}</dd>

                <dt class="col-sm-4">Descripción</dt>
                <dd class="col-sm-8">{{ $report->description }}</dd>

                <dt class="col-sm-4">Correo</dt>
                <dd class="col-sm-8">{{ $report->email }}</dd>

                <dt class="col-sm-4">Teléfono</dt>
                <dd class="col-sm-8">{{ $report->phone }}</dd>

                <dt class="col-sm-4">Área</dt>
                <dd class="col-sm-8">{{ $report->area->name ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Reportado por</dt>
                <dd class="col-sm-8">{{ $report->user->name ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Fecha</dt>
                <dd class="col-sm-8">{{ $report->created_at->format('d/m/Y H:i') }}</dd>
            </dl>

            <div class="d-flex justify-content-between mt-4">
                @can('update', $report)
                    <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                @endcan
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection