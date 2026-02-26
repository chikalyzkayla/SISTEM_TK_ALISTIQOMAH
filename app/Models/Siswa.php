<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kelas_id',
        'status',
    ];
    
    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}