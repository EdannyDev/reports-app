@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <!-- Titulo de la página de Login -->
                <h4 class="text-center mb-4">Bienvenido de nuevo</h4>

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

                <!-- Mostrar mensaje de error de login si el usuario no se autentica -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                <!-- Formulario de Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3 position-relative">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico" style="padding-left: 35px;">
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

                    <div class="form-group mb-4 text-center">
                        <button type="submit" class="btn btn-primary w-100">
                            Iniciar Sesión
                        </button>
                    </div>

                    <div class="form-group text-center">
                        <p class="small">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
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
            // Toggle the type attribute
            const type = password.type === "password" ? "text" : "password";
            password.type = type;
            // Toggle the icon
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
@endsection