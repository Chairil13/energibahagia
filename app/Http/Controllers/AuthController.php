<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login/register
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/')->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'identity_number' => 'nullable|string|max:50|unique:users',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'occupation' => 'nullable|string|max:100',
            'emergency_contact' => 'nullable|string|max:20',
            'emergency_name' => 'nullable|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'identity_number' => $request->identity_number,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'emergency_contact' => $request->emergency_contact,
            'emergency_name' => $request->emergency_name,
            'password' => Hash::make($request->password),
            'role' => 'donatur',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Selamat datang, '.$user->name.'! Akun Anda telah berhasil dibuat.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    // ==================== CRUD USER UNTUK ADMIN ====================

    public function adminProfile()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = Auth::user();

        return view('admin.profile', compact('user'));
    }

    public function users()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::orderBy('created_at')->orderBy('id')->get();

        return view('admin.users', compact('users'));
    }

    // Store user baru
    public function storeUser(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,donatur',
            'status' => 'required|in:0,1',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => (bool) $request->status,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,donatur',
            'status' => 'required|in:0,1',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->is_active = (bool) $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate');
    }

    // Delete user
    public function deleteUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        // Jangan hapus admin utama
        if ($user->email === 'admin@donasiku.com') {
            return redirect()->route('admin.users')->with('error', 'Tidak dapat menghapus admin utama!');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }
}
