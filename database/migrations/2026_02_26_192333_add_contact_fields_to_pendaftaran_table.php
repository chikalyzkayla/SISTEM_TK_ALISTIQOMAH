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
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('nama_pendaftar')->after('user_id');
            $table->string('nomor_telepon')->nullable()->after('nama_pendaftar');
            $table->string('email_pendaftar')->nullable()->after('nomor_telepon');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['nama_pendaftar', 'nomor_telepon', 'email_pendaftar']);
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
