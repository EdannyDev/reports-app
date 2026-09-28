<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Lista todos los usuarios del sistema (solo accesible por admin,
     * la middleware 'admin' ya lo garantiza a nivel de ruta).
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Cambia el rol de un usuario distinto al que hace la petición.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,employee',
        ]);

        // Evita que un admin se auto-degrade por error y se quede
        // sin poder gestionar el sistema.
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puedes cambiar tu propio rol desde aquí.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Rol de {$user->name} actualizado a {$request->role}.");
    }
}