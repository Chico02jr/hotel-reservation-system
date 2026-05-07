<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Traiter login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
    }

    // Afficher register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Traiter register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'nullable|string',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'client'
        ]);

        Auth::login($user);
        return redirect('/');
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}