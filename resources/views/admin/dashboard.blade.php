@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')

<div class="grid grid-cols-4 gap-4 mb-6">
    <!-- Card Total Siswa -->
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500 text-sm">TOTAL SISWA</div>
        <div class="text-3xl font-bold mt-2">{{ $totalSiswa }}</div>
        <div class="text-gray-400 text-xs mt-1">Siswa Aktif</div>
    </div>
    
    <!-- Card Total Guru -->
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500 text-sm">TOTAL GURU</div>
        <div class="text-3xl font-bold mt-2">{{ $totalGuru }}</div>
        <div class="text-gray-400 text-xs mt-1">Guru Aktif</div>
    </div>
    
    <!-- Card Orang Tua -->
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500 text-sm">ORANG TUA</div>
        <div class="text-3xl font-bold mt-2">{{ $totalOrangTua }}</div>
        <div class="text-gray-400 text-xs mt-1">Akun Terdaftar</div>
    </div>
    
    <!-- Card Total Kelas -->
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500 text-sm">TOTAL KELAS</div>
        <div class="text-3xl font-bold mt-2">{{ $totalKelas }}</div>
        <div class="text-gray-400 text-xs mt-1">Kelas Aktif</div>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <!-- Aktivitas Terbaru -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-bold mb-4">AKTIVITAS TERBARU</h3>
        <div class="space-y-3">
            <div class="border-b pb-2">
                <div class="font-medium">Data Siswa Baru Ditambahkan</div>
                <div class="text-xs text-gray-500">2 jam yang lalu</div>
            </div>
            <div class="border-b pb-2">
                <div class="font-medium">Pengguna Baru Terdaftar</div>
                <div class="text-xs text-gray-500">5 jam yang lalu</div>
            </div>
        </div>
    </div>
    
    <!-- Statistik Sistem -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-bold mb-4">STATISTIK SISTEM</h3>
        <div class="space-y-2">
            <div class="flex justify-between border-b pb-1">
                <span>TK A:</span>
                <span class="font-bold">22 Siswa</span>
            </div>
            <div class="flex justify-between border-b pb-1">
                <span>TK B:</span>
                <span class="font-bold">23 Siswa</span>
            </div>
        </div>
    </div>
</div>

@endsection