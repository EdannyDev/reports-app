@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 105vh;">
    <div class="card shadow-lg border-warning rounded" style="max-width: 450px; width: 100%; background-color: #f8f9fa;">
        <div class="card-header bg-warning text-black d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Editar Reporte</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('reports.update', $report->id) }}">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <i class="fas fa-heading"></i> Título
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $report->title) }}" placeholder="Ingrese el título del reporte" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="description" class="form-label">
                        <i class="fas fa-pencil-alt"></i> Descripción
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Ingrese una descripción detallada del reporte" required>{{ old('description', $report->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                 <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Correo Electrónico
                    </label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $report->email) }}" placeholder="Ingrese un correo electrónico válido" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i> Teléfono
                    </label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $report->phone) }}" placeholder="Ingrese un teléfono de contacto" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estatus -->
                <div class="mb-3">
                    <label for="status" class="form-label">
                        <i class="fas fa-check-circle"></i> Estatus
                    </label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ old('status', $report->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Área -->
                <div class="mb-3">
                    <label for="area_id" class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Área
                    </label>
                    <select class="form-control @error('area_id') is-invalid @enderror" id="area_id" name="area_id" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ old('area_id', $report->area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones: Actualizar Reporte y Regresar -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fas fa-pen"></i> Actualizar Reporte
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection