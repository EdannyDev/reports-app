@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-5 text-center">Configuración de Perfil</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x m-4 z-index-1050" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Mensaje de error -->
    @if(session('error'))
        <div id="errorMessage" class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x m-4 z-index-1050" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Formulario de Configuración de Perfil -->
    <form action="{{ route('profile.update') }}" method="POST" class="mx-auto" style="max-width: 900px;">
        @csrf
        @method('PUT')

        <!-- Sección de Nombre -->
        <div class="row mb-5">
            <div class="col-md-5 pe-4">
                <label for="name" class="form-label"><strong>Nombre</strong></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-7 ps-4">
                <p class="text-muted description-text">Este es tu nombre completo que aparece en tu perfil. Asegúrate de que sea el nombre correcto.</p>
            </div>
        </div>
        <hr class="custom-divider">

        <!-- Sección de Correo Electrónico -->
        <div class="row mb-5">
            <div class="col-md-5 pe-4">
                <label for="email" class="form-label"><strong>Correo Electrónico</strong></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-7 ps-4">
                <p class="text-muted description-text">Este es el correo que usas para iniciar sesión. Si cambias tu correo, recuerda actualizarlo en otros servicios relacionados.</p>
            </div>
        </div>
        <hr class="custom-divider">

        <!-- Sección de Nueva Contraseña -->
        <div class="row mb-5">
            <div class="col-md-5 pe-4">
                <label for="password" class="form-label"><strong>Nueva Contraseña</strong></label>
                <div class="position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mínimo 8 caracteres">
                    <i class="fa fa-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 cursor-pointer password-toggle" onclick="togglePassword('password')" id="password-eye"></i>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-7 ps-4">
                <p class="text-muted description-text">Si deseas cambiar tu contraseña, ingresa una nueva. Asegúrate de que sea segura. Déjalo vacío si no quieres modificarla.</p>
            </div>
        </div>
        <hr class="custom-divider">

        <!-- Sección de Confirmar Contraseña -->
        <div class="row mb-5">
            <div class="col-md-5 pe-4">
                <label for="password_confirmation" class="form-label"><strong>Confirmar Contraseña</strong></label>
                <div class="position-relative">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu nueva contraseña">
                    <i class="fa fa-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 cursor-pointer password-toggle" onclick="togglePassword('password_confirmation')" id="password_confirmation-eye"></i>
                </div>
            </div>
            <div class="col-md-7 ps-4">
                <p class="text-muted description-text">Reingresa la nueva contraseña para confirmarla. Asegúrate de que ambas contraseñas coincidan correctamente.</p>
            </div>
        </div>
        <hr class="custom-divider">

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                <i class="fa fa-trash"></i> Eliminar Cuenta
            </button>
        </div>
    </form>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Eliminar Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('profile.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .password-toggle {
        color: #6c757d;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #000;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .custom-divider {
        border-top: 1px solid rgb(71, 70, 70);  /* Línea divisora con el color correcto */
        margin: 2.5rem 0;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 8px;
    }

    .row {
        align-items: center;
    }

    .pe-4 {
        padding-right: 1.5rem !important;
    }

    .ps-4 {
        padding-left: 1.5rem !important;
    }

    .description-text {
        font-size: 1.1rem;  /* Aumenté el tamaño de la descripción */
        color: #6c757d;
        text-align: right; /* Alineación a la derecha */
        line-height: 1.6; /* Mejorando la legibilidad */
    }

    /* Animación de aparición suave */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animación de desaparición suave */
    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    /* Aplicar las animaciones */
    #successMessage, #errorMessage {
        width: 350px; /* Hacer la notificación más delgada pero más larga */
        animation: fadeIn 1s ease-out, fadeOut 1s ease-out 3s forwards;
    }

    /* Centrar la notificación en la parte superior */
    #successMessage, #errorMessage {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        margin: 10px;
        z-index: 1050;
    }
</style>

<!-- Scripts -->
<script>
    // Función para alternar la visibilidad de las contraseñas
    function togglePassword(id) {
        var passwordField = document.getElementById(id);
        var eyeIcon = document.getElementById(id + '-eye');
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }

    // Ocultar mensaje de éxito y error después de 4 segundos
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        if (successMessage) {
            successMessage.classList.add('fade');
        }
        if (errorMessage) {
            errorMessage.classList.add('fade');
        }
    }, 3000);
</script>

@endsection