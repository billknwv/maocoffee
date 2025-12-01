<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show signup form
    public function showSignup()
    {
        return view('auth.signup');
    }

    // Process signup
    public function processSignup(Request $request)
    {
        // Validasi
        $request->validate([
            'username' => 'required|min:3|max:255|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|max:255'
        ], [
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 3 karakter',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        // Create user (password TANPA hashing sesuai permintaan)
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password; // Password disimpan plain text
        $user->save();

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Process login
    public function processLogin(Request $request)
    {
        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        // Cari user by email
        $user = User::where('email', $request->email)->first();

        // Check user exists and password match (plain text comparison)
        if ($user && $user->password === $request->password) {
            // Simpan session
            session(['user_id' => $user->id_user, 'username' => $user->username]);
            
            // Redirect ke dashboard
            return redirect()->route('dashboard');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    // Logout
    public function logout()
    {
        session()->forget(['user_id', 'username']);
        return redirect()->route('login');
    }


    public function showChangePassword()
    {
        return view('dashboard.password.change');
    }

    /**
     * Proses ubah password
     */
    public function processChangePassword(Request $request)
    {
        // Validasi
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:255|different:current_password',
            'confirm_password' => 'required|same:new_password'
        ], [
            'current_password.required' => 'Password lama harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password.different' => 'Password baru harus berbeda dengan password lama',
            'confirm_password.required' => 'Konfirmasi password harus diisi',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password baru'
        ]);

        // Ambil user dari session
        $userId = session('user_id');
        $user = User::find($userId);

        if (!$user) {
            return back()->withErrors(['current_password' => 'User tidak ditemukan']);
        }

        // Cek password lama (karena kita simpan plain text)
        if ($user->password !== $request->current_password) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password (tetap plain text sesuai permintaan sebelumnya)
        $user->password = $request->new_password;
        $user->save();

        return redirect()->route('dashboard.password.change')
            ->with('success', 'Password berhasil diubah!');
    }
}