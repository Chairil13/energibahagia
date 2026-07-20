<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DonaturController extends Controller
{
    /**
     * Dashboard Donatur
     */
    public function dashboard()
    {
        $user = Auth::user();
        $userId = $user->id;

        // DEBUG
        Log::info('=== DASHBOARD DONATUR ===');
        Log::info('User ID: '.$userId);
        Log::info('User Name: '.$user->name);

        $totalDonasi = Donasi::where('user_id', $userId)->where('status', 'confirmed')->sum('nominal');
        $jumlahDonasi = Donasi::where('user_id', $userId)->where('status', 'confirmed')->count();
        $donasiPending = Donasi::where('user_id', $userId)->where('status', 'pending')->count();

        // CEK DONASI CANCELLED
        $donasiDitolak = Donasi::where('user_id', $userId)->where('status', 'cancelled')->count();

        Log::info('Donasi Ditolak: '.$donasiDitolak);

        // CEK SEMUA DONASI CANCELLED
        $allCancelled = Donasi::where('status', 'cancelled')->get();
        Log::info('Semua Donasi Cancelled: '.json_encode($allCancelled->pluck('kode_unik', 'user_id')));

        $donasiTerbaru = Donasi::where('user_id', $userId)
            ->with(['program', 'bank'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('donatur.dashboard', compact('totalDonasi', 'jumlahDonasi', 'donasiPending', 'donasiDitolak', 'donasiTerbaru'));
    }

    /**
     * Riwayat Donasi
     */
    public function history(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        Log::info('=== HISTORY DONATUR ===');
        Log::info('User ID: '.$userId);
        Log::info('Status Filter: '.$request->get('status'));

        $status = $request->get('status');

        $query = Donasi::where('user_id', $userId)->with(['program', 'bank']);

        if ($status && $status != 'all' && $status != '') {
            $query->where('status', $status);
        }

        // CEK QUERY
        Log::info('SQL: '.$query->toSql());
        Log::info('Bindings: '.json_encode($query->getBindings()));

        $donasis = $query->orderBy('created_at', 'desc')->paginate(10);

        Log::info('Total Data: '.$donasis->total());

        return view('donatur.history', compact('donasis', 'status'));
    }

    /**
     * Detail Donasi
     */
    public function detail($id)
    {
        $user = Auth::user();
        $userId = $user->id;

        $donasi = Donasi::where('user_id', $userId)
            ->with(['program', 'bank'])
            ->findOrFail($id);

        return view('donatur.detail', compact('donasi'));
    }

    /**
     * Profil Donatur
     */
    public function profile()
    {
        $user = Auth::user();

        return view('donatur.profile', compact('user'));
    }

    /**
     * Edit Profil Donatur
     */
    public function editProfile()
    {
        $user = Auth::user();

        return view('donatur.edit-profile', compact('user'));
    }

    /**
     * Update Profil Donatur
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'gender' => 'nullable|in:L,P',
            'occupation' => 'nullable|string|max:100',
            'emergency_contact' => 'nullable|string|max:20',
            'emergency_name' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->postal_code = $request->postal_code;
        $user->gender = $request->gender;
        $user->occupation = $request->occupation;
        $user->emergency_contact = $request->emergency_contact;
        $user->emergency_name = $request->emergency_name;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && file_exists(public_path('uploads/profile/'.$user->profile_photo))) {
                unlink(public_path('uploads/profile/'.$user->profile_photo));
            }

            $file = $request->file('profile_photo');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/profile');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $fileName);
            $user->profile_photo = $fileName;
        }

        $user->save();

        return redirect()->route('donatur.profile')->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Ganti Password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini salah!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}
