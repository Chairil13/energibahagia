@extends('layouts.admin')

@section('title', 'Profil Admin - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Profil Admin</h1>
        <p class="text-gray-500">Informasi akun administrator yang sedang login</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden max-w-3xl">
        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-[#8AD337] rounded-full flex items-center justify-center">
                    <span class="text-[#183D57] text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h2 class="text-white text-xl font-bold">{{ $user->name }}</h2>
                    <p class="text-white/70 text-sm">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 grid md:grid-cols-2 gap-4">
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Nama</p>
                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Email</p>
                <p class="font-semibold text-gray-800">{{ $user->email }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Role</p>
                <p class="font-semibold text-gray-800">{{ ucfirst($user->role) }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Status</p>
                <p class="font-semibold {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                    {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Telepon</p>
                <p class="font-semibold text-gray-800">{{ $user->phone ?? '-' }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Bergabung</p>
                <p class="font-semibold text-gray-800">{{ $user->created_at?->format('d F Y') ?? '-' }}</p>
            </div>
        </div>
    </div>
@endsection
