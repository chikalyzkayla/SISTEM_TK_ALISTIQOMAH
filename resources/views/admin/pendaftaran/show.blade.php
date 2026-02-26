@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')
@section('page-title', 'Detail Pendaftaran')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.pendaftaran.index') }}"
       class="text-blue-600 hover:underline text-sm">← Kembali ke Daftar</a>
</div>

<div class="max-w-3xl">

    <!-- Status Banner -->
    <div class="mb-4 flex items-center justify-between bg-white shadow rounded px-6 py-4">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Nomor Pendaftaran</p>
            <p class="text-xl font-bold font-mono">{{ $pendaftaran->nomor_pendaftaran }}</p>
        </div>
        <div>
            @if($pendaftaran->status == 'Pending')
                <span class="px-4 py-2 bg-yellow-400 text-white rounded-full font-semibold text-sm">Pending</span>
            @elseif($pendaftaran->status == 'Disetujui')
                <span class="px-4 py-2 bg-green-500 text-white rounded-full font-semibold text-sm">Disetujui</span>
            @else
                <span class="px-4 py-2 bg-red-500 text-white rounded-full font-semibold text-sm">Ditolak</span>
            @endif
        </div>
    </div>

    <!-- Data Detail -->
    <div class="bg-white shadow rounded p-6 mb-4">
        <div class="grid grid-cols-2 gap-6 text-sm">
            <div>
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">Data Calon Siswa</h3>
                <table class="w-full">
                    <tr class="border-b"><td class="py-2 text-gray-500 w-40">Nama Lengkap</td><td class="py-2 font-medium">{{ $pendaftaran->nama_lengkap_anak }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Tanggal Lahir</td><td class="py-2 font-medium">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir_anak)->format('d M Y') }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Jenis Kelamin</td><td class="py-2 font-medium">{{ $pendaftaran->jenis_kelamin_anak == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><td class="py-2 text-gray-500">Alamat</td><td class="py-2 font-medium">{{ $pendaftaran->alamat }}</td></tr>
                </table>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">Data Pendaftar</h3>
                <table class="w-full">
                    <tr class="border-b"><td class="py-2 text-gray-500 w-40">Nama</td><td class="py-2 font-medium">{{ $pendaftaran->nama_pendaftar }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Hubungan</td><td class="py-2 font-medium">{{ $pendaftaran->hubungan_pendaftar }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Telepon</td><td class="py-2 font-medium">{{ $pendaftaran->nomor_telepon ?? '-' }}</td></tr>
                    <tr class="border-b"><td class="py-2 text-gray-500">Email</td><td class="py-2 font-medium">{{ $pendaftaran->email_pendaftar ?? '-' }}</td></tr>
                    <tr><td class="py-2 text-gray-500">Tgl Daftar</td><td class="py-2 font-medium">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d M Y') }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Dokumen -->
    @if($pendaftaran->dokumen->isNotEmpty())
    <div class="bg-white shadow rounded p-6 mb-4">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3 text-sm">Dokumen Terupload</h3>
        <div class="grid grid-cols-2 gap-3">
            @foreach($pendaftaran->dokumen as $dok)
            <div class="flex items-center justify-between bg-gray-50 border rounded px-3 py-2 text-sm">
                <div>
                    <p class="font-medium text-gray-700">{{ $dok->jenis_dokumen }}</p>
                    <p class="text-xs text-gray-400">{{ $dok->nama_file }}</p>
                </div>
                <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank"
                   class="text-blue-600 hover:underline text-xs">Lihat</a>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white shadow rounded p-4 mb-4 text-sm text-gray-400">
        Tidak ada dokumen yang diupload.
    </div>
    @endif

    <!-- Aksi (hanya jika Pending) -->
    @if($pendaftaran->status == 'Pending')
    <div class="bg-white shadow rounded p-6">
        <h3 class="font-semibold text-gray-700 mb-4">Tindakan</h3>
        <div class="flex gap-3">
            <form method="POST" action="{{ route('admin.pendaftaran.setujui', $pendaftaran) }}"
                  onsubmit="return confirm('Setujui pendaftaran ini? Data siswa akan otomatis dibuat.')">
                @csrf
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Setujui & Buat Data Siswa
                </button>
            </form>
            <form method="POST" action="{{ route('admin.pendaftaran.tolak', $pendaftaran) }}"
                  onsubmit="return confirm('Tolak pendaftaran ini?')">
                @csrf
                <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 font-semibold">
                    Tolak Pendaftaran
                </button>
            </form>
        </div>
    </div>
    @endif

</div>
@endsection
