@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin-left: 29rem;">Gestión de Reportes</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Buscador por texto libre -->
        <form method="GET" action="{{ route('reports.index') }}" style="width: 30%;">
            <input type="text" name="search" class="form-control" placeholder="Buscar reportes..." value="{{ $search }}">
        </form>
        <a href="{{ route('reports.create') }}" class="btn btn-success ms-2">
            <i class="fas fa-file-lines"></i> Crear Reporte
        </a>
    </div>

    <table class="table table-striped" style="border: 1px solid #333;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Área</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ Str::limit($report->description, 50) }}</td>
                    <td>{{ $report->email }}</td>
                    <td>{{ $report->phone }}</td>
                    <td>
                        <span class="badge bg-{{ $report->status === 'completado' ? 'success' : ($report->status === 'pendiente' ? 'warning' : 'danger') }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </td>
                    <td>{{ $report->area->name ?? 'N/A' }}</td>
                    <td>{{ $report->user->name ?? 'N/A' }}</td>
                    <td>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar este reporte? Esta acción no se puede deshacer.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">Sin permisos</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No se encontraron reportes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $reports->links() }}
    </div>
</div>
@endsection