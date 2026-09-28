<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    /**
     * El rol nunca se decide con datos que el propio usuario controla
     * (como el dominio de su correo). El primer usuario del sistema
     * se vuelve admin de forma automática; el resto queda como
     * 'employee' y solo puede ser ascendido por un admin existente.
     */
    public function store(RegisterRequest $request)
    {
        $isFirstUser = User::count() === 0;

        $user = User::create([
            ...$request->validated(),
            'password' => Hash::make($request->validated('password')),
            'role' => $isFirstUser ? 'admin' : 'employee',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}