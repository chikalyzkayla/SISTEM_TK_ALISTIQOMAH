<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPendaftaran extends Model
{
    protected $table = 'dokumen_pendaftaran';

    protected $fillable = [
        'pendaftaran_id',
        'jenis_dokumen',
        'nama_file',
        'path_file',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
