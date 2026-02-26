<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Siswa;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::latest()->paginate(10);
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load('dokumen');
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function setujui(Pendaftaran $pendaftaran)
    {
        $count = Siswa::whereYear('created_at', now()->year)->count() + 1;
        $nis = now()->year . str_pad($count, 3, '0', STR_PAD_LEFT);

        Siswa::create([
            'nis'           => $nis,
            'nama_lengkap'  => $pendaftaran->nama_lengkap_anak,
            'tanggal_lahir' => $pendaftaran->tanggal_lahir_anak,
            'jenis_kelamin' => $pendaftaran->jenis_kelamin_anak,
            'alamat'        => $pendaftaran->alamat,
            'status'        => 'Aktif',
        ]);

        $pendaftaran->update(['status' => 'Disetujui']);

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran disetujui. Data siswa berhasil ditambahkan dengan NIS ' . $nis . '.');
    }

    public function tolak(Pendaftaran $pendaftaran)
    {
        $pendaftaran->update(['status' => 'Ditolak']);

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran atas nama ' . $pendaftaran->nama_lengkap_anak . ' telah ditolak.');
    }
}
