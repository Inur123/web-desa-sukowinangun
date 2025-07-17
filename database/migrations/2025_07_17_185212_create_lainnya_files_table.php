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
        Schema::create('lainnya_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lainnya_id')->constrained('lainnya')->onDelete('cascade');
            $table->string('nama'); // Nama keterangan file
            $table->string('file'); // Path file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lainnya_files');
    }
};
