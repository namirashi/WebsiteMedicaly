<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Tampilkan form lupa password
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // Cari user berdasarkan nama atau email
    public function find(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
        ]);

        // Cari user by name atau email
        $user = User::where('name', $request->identity)
                    ->orWhere('email', $request->identity)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'not_found' => 'Nama pengguna atau email tidak ditemukan.'
            ])->withInput();
        }

        // Simpan user_id ke session
        session(['reset_user_id' => $user->id]);

        return view('auth.reset-password', compact('user'));
    }

    // Tampilkan form reset password
    public function showReset(Request $request)
    {
        $userId = session('reset_user_id');
        if (!$userId) {
            return redirect()->route('password.forgot')->with('error', 'Sesi tidak valid. Silakan coba lagi.');
        }

        $user = User::findOrFail($userId);
        return view('auth.reset-password', compact('user'));
    }

    // Proses reset password
    public function update(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'password' => 'required|min:6|confirmed',
        ]);

        // Verifikasi session cocok dengan user_id
        if (session('reset_user_id') != $request->user_id) {
            return redirect()->route('password.forgot')->withErrors([
                'not_found' => 'Sesi tidak valid. Silakan mulai ulang.'
            ]);
        }

        $user = User::findOrFail($request->user_id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus session reset
        session()->forget('reset_user_id');

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diubah! Silakan masuk dengan kata sandi baru.');
    }
}