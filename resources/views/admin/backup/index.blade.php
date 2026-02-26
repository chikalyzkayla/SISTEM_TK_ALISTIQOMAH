@extends('layouts.admin')

@section('title', 'Backup Database')
@section('page-title', 'Backup & Restore Database')

@section('content')

{{-- Notifikasi --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif

{{-- Tombol Buat Backup --}}
<div class="bg-white p-6 rounded shadow mb-4">
    <h3 class="font-bold mb-4">BUAT BACKUP BARU</h3>
    <p class="text-gray-600 mb-4">
        Klik tombol di bawah untuk membuat backup database. 
        Backup akan disimpan dalam format SQL.
    </p>
    <form method="POST" action="{{ route('admin.backup.create') }}">
        @csrf
        <button type="submit" 
                class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700"
                onclick="return confirm('Yakin ingin membuat backup?')">
            BUAT BACKUP SEKARANG
        </button>
    </form>
</div>

{{-- Daftar Backup --}}
<div class="bg-white shadow rounded">
    <div class="p-4 bg-gray-800 text-white font-bold">
        DAFTAR BACKUP
    </div>
    
    @if(count($backups) > 0)
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">NO</th>
                <th class="px-4 py-2 text-left">NAMA FILE</th>
                <th class="px-4 py-2 text-left">UKURAN</th>
                <th class="px-4 py-2 text-left">TANGGAL</th>
                <th class="px-4 py-2 text-left">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $index => $backup)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $backup['name'] }}</td>
                <td class="px-4 py-2">{{ $backup['size'] }}</td>
                <td class="px-4 py-2">{{ $backup['date'] }}</td>
                <td class="px-4 py-2">
                    {{-- Tombol Download --}}
                    <a href="{{ route('admin.backup.download', $backup['name']) }}" 
                       class="text-blue-600 hover:underline mr-3">
                        Download
                    </a>
                    
                    {{-- Tombol Hapus --}}
                    <form method="POST" 
                          action="{{ route('admin.backup.delete', $backup['name']) }}" 
                          class="inline"
                          onsubmit="return confirm('Yakin hapus backup ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                        Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="p-8 text-center text-gray-500">
        Belum ada backup. Klik "BUAT BACKUP SEKARANG" untuk membuat backup pertama.
    </div>
    @endif
</div>

{{-- Informasi --}}
<div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded mt-4">
    <p class="font-bold">PENTING:</p>
    <ul class="list-disc ml-6 mt-2">
        <li>Backup database secara rutin (minimal 1x per minggu)</li>
        <li>Download backup dan simpan di tempat aman (Google Drive, USB)</li>
        <li>Untuk restore, import file SQL via phpMyAdmin atau HeidiSQL</li>
    </ul>
</div>

@endsection
