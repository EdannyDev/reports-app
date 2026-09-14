@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin-left: 29rem;">Gestión de Reportes</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Input de búsqueda -->
        <div style="width: 30%;">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar reportes...">
        </div>
        <!-- Botón de Crear Reporte (Siempre visible) -->
        <a href="{{ route('reports.create') }}" class="btn btn-success ms-2">
            <i class="fas fa-file-lines"></i> Crear Reporte
        </a>
    </div>

    <div id="tableContainer">
        <!-- Contorno exterior de la tabla, sin borde para las filas y con esquinas redondeadas -->
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
            <tbody id="reportsTable">
                @foreach($reports as $report)
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
                            @if(Auth::user()->role === 'admin')
                                <!-- Botones para administradores -->
                                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Botón de Eliminar con modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal de Confirmación de Eliminación -->
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
                                <!-- Para empleados, solo mostrar mensaje -->
                                <span class="text-muted">Sin permisos</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="paginationControls" class="d-flex justify-content-center"></div>
    </div>
</div>

<script>
    let currentPage = 1;
    const rowsPerPage = 5;
    const reports = @json($reports); // Todos los reportes
    const tableBody = document.getElementById('reportsTable');
    const searchInput = document.getElementById('searchInput');
    const paginationControls = document.getElementById('paginationControls');

    function renderTable(filteredReports) {
        const start = (currentPage - 1) * rowsPerPage;
        const paginatedReports = filteredReports.slice(start, start + rowsPerPage);

        tableBody.innerHTML = '';
        paginatedReports.forEach(report => {
            const userRole = '{{ Auth::user()->role }}';
            const isAdmin = userRole === 'admin';

            tableBody.innerHTML += `
                <tr>
                    <td>${report.id}</td>
                    <td>${report.title}</td>
                    <td>${report.description.slice(0, 50)}</td>
                    <td>${report.email}</td>
                    <td>${report.phone}</td>
                    <td>
                        <span class="badge bg-${report.status === 'completado' ? 'success' : report.status === 'pendiente' ? 'warning' : 'danger'}">
                            ${report.status.charAt(0).toUpperCase() + report.status.slice(1)}
                        </span>
                    </td>
                    <td>${report.area?.name || 'N/A'}</td>
                    <td>${report.user?.name || 'N/A'}</td>
                    <td>
                        ${isAdmin ? `
                            <a href="/reports/${report.id}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal${report.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="deleteModal${report.id}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                            <form action="/reports/${report.id}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ` : '<span class="text-muted">Sin permisos</span>'}
                    </td>
                </tr>
            `;
        });

        renderPagination(filteredReports.length);
    }

    function renderPagination(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        paginationControls.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            paginationControls.innerHTML += `
                <button class="btn ${i === currentPage ? 'btn-primary' : 'btn-secondary'} mx-1" onclick="changePage(${i})">
                    ${i}
                </button>
            `;
        }
    }

    function changePage(page) {
        currentPage = page;
        filterAndRender();
    }

    function filterAndRender() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredReports = reports.filter(report =>
            report.title.toLowerCase().includes(searchTerm) ||
            report.description.toLowerCase().includes(searchTerm) ||
            report.email.toLowerCase().includes(searchTerm) ||
            report.phone.toLowerCase().includes(searchTerm) ||
            report.status.toLowerCase().includes(searchTerm) ||
            (report.area?.name.toLowerCase() || '').includes(searchTerm) ||
            (report.user?.name.toLowerCase() || '').includes(searchTerm)
        );
        renderTable(filteredReports);
    }

    searchInput.addEventListener('input', filterAndRender);
    filterAndRender(); // Inicializar con los reportes
</script>
@endsection