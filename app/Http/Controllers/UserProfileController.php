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
        return view('users.profile');
    }

    // Actualiza el perfil
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:8',
            'role' => 'nullable|in:admin,employee',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Solo un admin puede reasignar el rol de la cuenta.
        if ($user->isAdmin() && isset($validated['role'])) {
            $user->role = $validated['role'];
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Perfil actualizado correctamente.');
    }

    // Elimina la cuenta de usuario
    public function delete(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}