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
    Schema::create('pendaftaran', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_pendaftaran')->unique();
        $table->foreignId('user_id')->constrained('users');
        $table->string('nama_lengkap_anak');
        $table->date('tanggal_lahir_anak');
        $table->enum('jenis_kelamin_anak', ['L', 'P']);
        $table->text('alamat');
        $table->enum('hubungan_pendaftar', ['Ayah', 'Ibu', 'Wali']);
        $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
        $table->date('tanggal_pendaftaran');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
