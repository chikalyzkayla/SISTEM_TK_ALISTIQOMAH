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
    Schema::create('kehadiran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
        $table->foreignId('kelas_id')->constrained('kelas');
        $table->date('tanggal');
        $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alfa']);
        $table->text('keterangan')->nullable();
        $table->foreignId('dicatat_oleh')->constrained('users'); // Guru
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
