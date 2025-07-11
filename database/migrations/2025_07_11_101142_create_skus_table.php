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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir'); // Tambahan
            $table->date('ttl'); // Tanggal Lahir
            $table->string('nik');
            $table->text('alamat');
            $table->string('status_perkawinan');
            $table->string('nama_usaha');
            $table->text('alamat_usaha');
            $table->string('keperluan');
            $table->string('pengantar_rt'); // file path
            $table->string('ktp'); // file path
            $table->enum('status', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
