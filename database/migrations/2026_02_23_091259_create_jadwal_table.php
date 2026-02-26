<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kegiatan');
        $table->date('tanggal');
        $table->time('waktu_mulai');
        $table->time('waktu_selesai');
        $table->string('tempat')->nullable();
        $table->foreignId('kelas_id')->nullable()->constrained('kelas');
        $table->text('deskripsi')->nullable();
        $table->foreignId('dibuat_oleh')->constrained('users'); // Guru
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
