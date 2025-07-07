<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil login, cek role-nya
            if (Auth::user()->role === 'pemilik') {
                return redirect('/laporan'); // redirect ke laporan kalau pemilik
            } else {
                return redirect('/dashboard'); // redirect ke dashboard kasir
            }
        }

        return back()->with('error', 'Login gagal. Cek email & password.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan!');
    }
}
