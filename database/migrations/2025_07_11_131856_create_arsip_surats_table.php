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
         Schema::create('arsip_surats', function (Blueprint $table) {
            $table->id();
            $table->text('nomor_surat')->nullable();
            $table->text('pengirim_penerima')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('jenis', ['masuk', 'keluar'])->nullable();
            $table->string('file_surat')->nullable(); // path file terenkripsi
            $table->text('deskripsi')->nullable(); // tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
