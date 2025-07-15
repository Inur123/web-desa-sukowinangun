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
        Schema::create('kehilangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('ttl')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('surat_yang_hilang')->nullable(); // KK/KTP/Akta/ATM/Buku dll
            $table->string('keperluan')->nullable();
            $table->string('kk')->nullable();
            $table->string('ktp')->nullable();
            $table->string('pengantar_rt')->nullable();
            $table->enum('status', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehilangan');
    }
};
