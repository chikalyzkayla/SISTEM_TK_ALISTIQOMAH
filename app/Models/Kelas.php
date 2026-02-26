<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    
    protected $fillable = [
        'nama_kelas',
        'wali_kelas_id',
        'kapasitas',
    ];
    
    // Relasi ke Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}