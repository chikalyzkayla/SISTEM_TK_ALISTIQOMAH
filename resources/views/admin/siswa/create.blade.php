@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-title', 'Tambah Siswa Baru')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.siswa.store') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">NIS (Nomor Induk Siswa) *</label>
            <input type="text" name="nis" required 
                   class="w-full border rounded px-3 py-2 @error('nis') border-red-500 @enderror"
                   value="{{ old('nis') }}"
                   placeholder="Contoh: 2024001">
            @error('nis')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">NAMA LENGKAP *</label>
            <input type="text" name="nama_lengkap" required 
                   class="w-full border rounded px-3 py-2 @error('nama_lengkap') border-red-500 @enderror"
                   value="{{ old('nama_lengkap') }}">
            @error('nama_lengkap')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">TANGGAL LAHIR *</label>
            <input type="date" name="tanggal_lahir" required 
                   class="w-full border rounded px-3 py-2 @error('tanggal_lahir') border-red-500 @enderror"
                   value="{{ old('tanggal_lahir') }}">
            @error('tanggal_lahir')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">JENIS KELAMIN *</label>
            <select name="jenis_kelamin" required 
                    class="w-full border rounded px-3 py-2 @error('jenis_kelamin') border-red-500 @enderror">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">ALAMAT</label>
            <textarea name="alamat" rows="3"
                      class="w-full border rounded px-3 py-2 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">KELAS</label>
            <select name="kelas_id" 
                    class="w-full border rounded px-3 py-2 @error('kelas_id') border-red-500 @enderror">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
                @endforeach
            </select>
            @error('kelas_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">STATUS *</label>
            <select name="status" required 
                    class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror">
                <option value="">-- Pilih Status --</option>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="Lulus" {{ old('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
            </select>
            @error('status')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex gap-2">
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                SIMPAN SISWA
            </button>
            <a href="{{ route('admin.siswa.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                BATAL
            </a>
        </div>
    </form>
</div>
@endsection