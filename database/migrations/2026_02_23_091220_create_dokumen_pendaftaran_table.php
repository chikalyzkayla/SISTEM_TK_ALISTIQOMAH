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
    Schema::create('dokumen_pendaftaran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
        $table->enum('jenis_dokumen', ['KK', 'Akta Kelahiran', 'KTP Orang Tua', 'Foto']);
        $table->string('nama_file');
        $table->string('path_file');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendaftaran');
    }
};
