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
       Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->enum('status', ['active', 'nonactive'])->default('nonactive');
        $table->text('content')->nullable();
        $table->text('summary')->nullable();
        $table->string('image')->nullable();
        $table->string('category'); // ⬅️ Ganti dari category_id ke category (string)
        $table->date('published_at')->nullable();
        $table->unsignedBigInteger('views')->default(0); // Tambahkan kolom views
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
