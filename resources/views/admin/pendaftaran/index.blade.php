@extends('layouts.admin')

@section('title', 'Pendaftaran Siswa')
@section('page-title', 'Pendaftaran Siswa')

@section('content')
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 text-left">NO</th>
                <th class="px-4 py-2 text-left">NOMOR DAFTAR</th>
                <th class="px-4 py-2 text-left">NAMA ANAK</th>
                <th class="px-4 py-2 text-left">PENDAFTAR</th>
                <th class="px-4 py-2 text-left">TGL DAFTAR</th>
                <th class="px-4 py-2 text-left">STATUS</th>
                <th class="px-4 py-2 text-left">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftaran as $index => $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $pendaftaran->firstItem() + $index }}</td>
                <td class="px-4 py-2 font-mono text-sm">{{ $p->nomor_pendaftaran }}</td>
                <td class="px-4 py-2">{{ $p->nama_lengkap_anak }}</td>
                <td class="px-4 py-2">
                    {{ $p->nama_pendaftar }}<br>
                    <span class="text-xs text-gray-400">{{ $p->hubungan_pendaftar }}</span>
                </td>
                <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($p->tanggal_pendaftaran)->format('d M Y') }}</td>
                <td class="px-4 py-2">
                    @if($p->status == 'Pending')
                        <span class="px-2 py-1 bg-yellow-400 text-white text-xs rounded">Pending</span>
                    @elseif($p->status == 'Disetujui')
                        <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">Disetujui</span>
                    @else
                        <span class="px-2 py-1 bg-red-500 text-white text-xs rounded">Ditolak</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.pendaftaran.show', $p) }}"
                       class="text-blue-600 hover:underline">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                    Belum ada data pendaftaran.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">
        {{ $pendaftaran->links() }}
    </div>
</div>
@endsection
