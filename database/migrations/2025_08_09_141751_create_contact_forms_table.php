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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('no_telepon');
            $table->string('email');
            $table->enum('jenis_kebutuhan', [
                'Pelayanan Administrasi',
                'Pengaduan Masyarakat',
                'Permintaan Informasi',
                'Lainnya'
            ]);
            $table->text('pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};
