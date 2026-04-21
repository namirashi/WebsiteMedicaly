<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required', // bisa name atau email
            'password' => 'required',
        ]);

        // Tentukan apakah input itu email atau name
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $field => $request->login,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            // Log login
            SystemLog::create([
                'level' => 'info',
                'message' => 'User login: ' . $request->login,
                'ip_address' => $request->ip(),
                'user_id' => auth()->id(),
            ]);

            return auth()->user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return back()->withErrors([
            'login' => 'Username / Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}