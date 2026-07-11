<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        try {
            if (Auth::check()) {
                return redirect('/dashboard');
            }
        } catch (\Throwable $e) {
            // Abaikan jika auth belum bisa membaca dari database.
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('/dashboard');
            }
        } catch (\Throwable $e) {
            return back()->withErrors(['email' => 'Login belum bisa diproses karena database belum siap.']);
        }

        return back()->withErrors(['email' => 'Kredensial tidak valid.']);
    }

    public function showRegister(): View
    {
        try {
            if (Auth::check()) {
                return redirect('/dashboard');
            }
        } catch (\Throwable $e) {
            // Abaikan jika auth belum bisa membaca dari database.
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'staff',
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Throwable $e) {
            return back()->withErrors(['email' => 'Registrasi belum bisa diproses karena database belum siap.']);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (\Throwable $e) {
            // Lewati jika sesi belum siap.
        }

        return redirect('/login');
    }
}
