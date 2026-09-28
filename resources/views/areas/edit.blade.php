@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg border-warning rounded" style="max-width: 450px; width: 100%; background-color: #f8f9fa;">
        <div class="card-header bg-warning text-black">
            <h4 class="mb-0">Editar Área</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('areas.update', $area->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $area->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-pen"></i> Actualizar Área
                    </button>
                    <a href="{{ route('areas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection