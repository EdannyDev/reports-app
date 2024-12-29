<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    // Muestra la página de perfil
    public function show()
    {
        return view('user.profile');
    }

    // Actualiza el perfil
    public function update(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:8',
            'role' => 'nullable|in:user,admin', // Solo puede ser 'user' o 'admin'
        ]);

        // Actualizar nombre y email
        $user = Auth::user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Si el usuario es administrador, actualizar el rol (pero no permitas que lo cambie en la vista)
        if (Auth::user()->is_admin && isset($validated['role'])) {
            $user->role = $validated['role'];
        }

        // Si hay una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Guardar cambios
        $user->save();

        return redirect()->route('profile')->with('success', 'Perfil actualizado correctamente.');
    }

    // Elimina la cuenta de usuario
    public function delete(Request $request)
    {
        $user = Auth::user();

        // Eliminar la cuenta de usuario
        $user->delete();

        // Cerrar sesión después de eliminar la cuenta
        Auth::logout();

        // Redirigir al usuario a la página de inicio
        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
