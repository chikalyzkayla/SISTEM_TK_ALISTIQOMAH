<?php

namespace App\Http\Controllers;

use App\Models\DokumenPendaftaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap_anak'  => 'required|string|max:255',
            'tanggal_lahir_anak' => 'required|date',
            'jenis_kelamin_anak' => 'required|in:L,P',
            'alamat'             => 'required|string',
            'nama_pendaftar'     => 'required|string|max:255',
            'hubungan_pendaftar' => 'required|in:Ayah,Ibu,Wali',
            'nomor_telepon'      => 'nullable|string|max:20',
            'email_pendaftar'    => 'nullable|email|max:255',
            'dokumen_kk'             => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_akta'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_ktp'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_foto'           => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $count = Pendaftaran::whereYear('created_at', now()->year)->count() + 1;
        $nomorPendaftaran = 'PEND-' . now()->year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        $pendaftaran = Pendaftaran::create([
            'nomor_pendaftaran'  => $nomorPendaftaran,
            'nama_lengkap_anak'  => $request->nama_lengkap_anak,
            'tanggal_lahir_anak' => $request->tanggal_lahir_anak,
            'jenis_kelamin_anak' => $request->jenis_kelamin_anak,
            'alamat'             => $request->alamat,
            'nama_pendaftar'     => $request->nama_pendaftar,
            'hubungan_pendaftar' => $request->hubungan_pendaftar,
            'nomor_telepon'      => $request->nomor_telepon,
            'email_pendaftar'    => $request->email_pendaftar,
            'status'             => 'Pending',
            'tanggal_pendaftaran'=> now()->toDateString(),
        ]);

        $dokumenMap = [
            'dokumen_kk'    => 'KK',
            'dokumen_akta'  => 'Akta Kelahiran',
            'dokumen_ktp'   => 'KTP Orang Tua',
            'dokumen_foto'  => 'Foto',
        ];

        foreach ($dokumenMap as $field => $jenis) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $namaFile = $file->getClientOriginalName();
                $path = $file->store('dokumen-pendaftaran', 'public');

                DokumenPendaftaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'jenis_dokumen'  => $jenis,
                    'nama_file'      => $namaFile,
                    'path_file'      => $path,
                ]);
            }
        }

        return redirect()->route('pendaftaran.status', $nomorPendaftaran)
            ->with('success', 'Pendaftaran berhasil dikirim! Simpan nomor pendaftaran Anda.');
    }

    public function status($nomor)
    {
        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $nomor)
            ->with('dokumen')
            ->firstOrFail();

        return view('pendaftaran.status', compact('pendaftaran'));
    }
}
