<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Tampilkan list semua siswa
    public function index()
    {
        $siswa = Siswa::with('kelas')->latest()->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }
    
    // Tampilkan form tambah siswa
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }
    
    // Simpan siswa baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|unique:siswa',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
            'status' => 'required|in:Aktif,Tidak Aktif,Lulus',
        ]);
        
        Siswa::create($validated);
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }
    
    // Tampilkan form edit siswa
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }
    
    // Update data siswa
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|string|unique:siswa,nis,'.$siswa->id,
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
            'status' => 'required|in:Aktif,Tidak Aktif,Lulus',
        ]);
        
        $siswa->update($validated);
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diupdate');
    }
    
    // Hapus siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}