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
        Schema::create('sktm', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('ttl')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('nama_anak')->nullable();
            $table->string('keperluan')->nullable();
            $table->string('pengantar_rt')->nullable();
            $table->string('kk')->nullable();
            $table->string('ktp')->nullable();
            $table->enum('status', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->text('no_hp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sktm');
    }
};
