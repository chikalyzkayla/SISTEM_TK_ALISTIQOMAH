@extends('layouts.admin')

@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna Baru')

@section('content')

<div class="bg-white shadow rounded p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        
        {{-- Role --}}
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">ROLE PENGGUNA *</label>
            <select name="role" required 
                    class="w-full border rounded px-3 py-2 @error('role') border-red-500 @enderror">
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Guru" {{ old('role') == 'Guru' ? 'selected' : '' }}>Guru</option>
                <option value="Orang Tua" {{ old('role') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
            </select>
            @error('role')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Nama --}}
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">NAMA LENGKAP *</label>
            <input type="text" name="name" required 
                   class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror"
                   value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">EMAIL *</label>
            <input type="email" name="email" required 
                   class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}">
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">PASSWORD *</label>
            <input type="password" name="password" required 
                   class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Konfirmasi Password --}}
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">KONFIRMASI PASSWORD *</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full border rounded px-3 py-2">
        </div>
        
        {{-- Tombol --}}
        <div class="flex gap-2">
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                SIMPAN PENGGUNA
            </button>
            <a href="{{ route('admin.users.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                BATAL
            </a>
        </div>
    </form>
</div>

@endsection