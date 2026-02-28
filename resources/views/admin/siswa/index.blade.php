@extends('layouts.admin')

@section('title', 'Kelola Siswa')
@section('page-title', 'Kelola Data Siswa')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.siswa.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah Siswa Baru
    </a>
</div>

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
                <th class="px-4 py-2 text-left">NIS</th>
                <th class="px-4 py-2 text-left">NAMA LENGKAP</th>
                <th class="px-4 py-2 text-left">KELAS</th>
                <th class="px-4 py-2 text-left">JK</th>
                <th class="px-4 py-2 text-left">STATUS</th>
                <th class="px-4 py-2 text-left">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswa as $index => $s)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $siswa->firstItem() + $index }}</td>
                <td class="px-4 py-2">{{ $s->nis }}</td>
                <td class="px-4 py-2">{{ $s->nama_lengkap }}</td>
                <td class="px-4 py-2">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                <td class="px-4 py-2">{{ $s->jenis_kelamin }}</td>
                <td class="px-4 py-2">
                    @if($s->status == 'Aktif')
                        <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">Aktif</span>
                    @elseif($s->status == 'Lulus')
                        <span class="px-2 py-1 bg-blue-500 text-white text-xs rounded">Lulus</span>
                    @else
                        <span class="px-2 py-1 bg-gray-500 text-white text-xs rounded">Tidak Aktif</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.siswa.edit', $s) }}" 
                       class="text-blue-600 hover:underline mr-3">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.siswa.destroy', $s) }}" 
                          class="inline" 
                          onsubmit="return confirm('Yakin hapus siswa ini?')">
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
                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                    Belum ada data siswa. Klik "Tambah Siswa Baru" untuk menambahkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">
        {{ $siswa->links() }}
    </div>
</div>
@endsection