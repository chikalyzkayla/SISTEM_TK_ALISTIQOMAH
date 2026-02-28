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
    Schema::create('laporan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
        $table->enum('jenis_laporan', ['Harian', 'Mingguan', 'Bulanan', 'Semester']);
        $table->date('tanggal_laporan');
        $table->string('periode'); // Contoh: "Semester 1 2024/2025"
        $table->text('isi_laporan');
        $table->foreignId('dibuat_oleh')->constrained('users'); // Guru
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
