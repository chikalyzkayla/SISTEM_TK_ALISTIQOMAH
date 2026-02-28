<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'nomor_pendaftaran',
        'user_id',
        'nama_pendaftar',
        'nomor_telepon',
        'email_pendaftar',
        'nama_lengkap_anak',
        'tanggal_lahir_anak',
        'jenis_kelamin_anak',
        'alamat',
        'hubungan_pendaftar',
        'status',
        'tanggal_pendaftaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPendaftaran::class);
    }
}
