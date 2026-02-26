@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Data Pengguna')

@section('content')

{{-- Tombol Tambah --}}
<div class="mb-4">
    <a href="{{ route('admin.users.create') }}" 
       class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 font-bold">
        ➕ Tambah Pengguna Baru
    </a>
</div>

{{-- Notifikasi Sukses --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- Tabel Data User --}}
<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 text-left">NO</th>
                <th class="px-4 py-2 text-left">NAMA</th>
                <th class="px-4 py-2 text-left">EMAIL</th>
                <th class="px-4 py-2 text-left">ROLE</th>
                <th class="px-4 py-2 text-left">TGL DAFTAR</th>
                <th class="px-4 py-2 text-left">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $users->firstItem() + $index }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">
                    @if($user->role == 'Admin')
                        <span class="px-2 py-1 bg-red-500 text-white text-xs rounded">Admin</span>
                    @elseif($user->role == 'Guru')
                        <span class="px-2 py-1 bg-blue-500 text-white text-xs rounded">Guru</span>
                    @else
                        <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">Orang Tua</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                       class="text-blue-600 hover:underline mr-3">
                        Edit
                    </a>
                    <form method="POST" 
                          action="{{ route('admin.users.destroy', $user) }}" 
                          class="inline" 
                          onsubmit="return confirm('Yakin hapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                    Belum ada data pengguna.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    {{-- Pagination --}}
    <div class="p-4">
        {{ $users->links() }}
    </div>
</div>

@endsection