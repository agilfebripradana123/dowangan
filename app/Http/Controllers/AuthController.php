<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return match (Auth::user()->role) {
                'admin'  => redirect()->route('admin.dashboard'),
                'pemuda' => redirect()->route('admin.content.index'), // atau admin.pemuda.index
                default  => redirect()->route('user.home'),
            };
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $default = match (Auth::user()->role) {
                'admin'  => route('admin.dashboard'),
                'pemuda' => route('admin.content.index'),
                default  => route('user.home'),
            };

            return redirect()->intended($default);
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda berhasil logout.');
    }
}
