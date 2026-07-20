<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterDonaturRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Daftar semua donatur
    public function donaturs()
    {
        $donaturs = User::donaturs()->active()->latest()->paginate(10);
        return view('donaturs.index', compact('donaturs'));
    }

    // Daftar semua admin
    public function admins()
    {
        $admins = User::admins()->latest()->paginate(10);
        return view('admins.index', compact('admins'));
    }

    // Form register donatur
    public function showRegisterForm()
    {
        return view('auth.register-donatur');
    }

    // Proses register donatur
    public function registerDonatur(RegisterDonaturRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donatur',
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
        ]);

        // Login setelah register
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Detail donatur
    public function showDonatur(User $user)
    {
        if (!$user->isDonatur()) {
            abort(404);
        }

        return view('donaturs.show', compact('user'));
    }

    // Update profil donatur
    public function updateDonatur(Request $request, User $user)
    {
        // Validasi dan update
        $user->update($request->only([
            'name',
            'phone',
            'address',
            'city',
            'province',
            'postal_code',
            'occupation',
            'emergency_contact',
            'emergency_name'
        ]));

        return back()->with('success', 'Profil berhasil diupdate');
    }
}
