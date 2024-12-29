<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisteredUserController extends Controller
{
    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');  // Vista del formulario de registro
    }

    /**
     * Maneja el registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Determinar el rol basado en el dominio del correo
        $role = str_ends_with($request->email, '@loscincosoles.com') ? 'admin' : 'employee';

        // Crear el usuario con el rol determinado
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Hashea la contraseña
            'role' => $role,  // Asigna el rol aquí
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir al usuario después del registro
        return redirect()->route('home');  // Cambia 'home' por la ruta que deseas después del login
    }
}
