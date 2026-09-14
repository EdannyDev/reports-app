@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <!-- Titulo de la página de Registro -->
                <h4 class="text-center mb-4">Crea tu cuenta</h4>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario de Registro -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3 position-relative">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus placeholder="Nombre" style="padding-left: 35px;">
                        <i class="fas fa-user position-absolute" style="top: 10px; left: 10px;"></i>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Correo Electrónico" style="padding-left: 35px;">
                        <i class="fas fa-envelope position-absolute" style="top: 10px; left: 10px;"></i>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Contraseña" style="padding-left: 35px; padding-right: 35px;">
                        <i class="fas fa-lock position-absolute" style="top: 10px; left: 10px;"></i>
                        <i class="fas fa-eye-slash position-absolute" id="togglePassword" style="top: 10px; right: 10px; cursor: pointer;"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4 position-relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required placeholder="Confirmar Contraseña" style="padding-left: 35px; padding-right: 35px;">
                        <i class="fas fa-lock position-absolute" style="top: 10px; left: 10px;"></i>
                        <i class="fas fa-eye-slash position-absolute" id="togglePasswordConfirmation" style="top: 10px; right: 10px; cursor: pointer;"></i>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4 text-center">
                        <button type="submit" class="btn btn-primary w-100">
                            Registrar
                        </button>
                    </div>

                    <div class="form-group text-center">
                        <p class="small">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para mostrar/ocultar la contraseña -->
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            const type = password.type === "password" ? "text" : "password";
            password.type = type;
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });

        // Mostrar/ocultar la contraseña de confirmación
        const togglePasswordConfirmation = document.getElementById("togglePasswordConfirmation");
        const passwordConfirmation = document.getElementById("password_confirmation");

        togglePasswordConfirmation.addEventListener("click", function() {
            const type = passwordConfirmation.type === "password" ? "text" : "password";
            passwordConfirmation.type = type;
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
@endsection