<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('konten')->nullable();
            $table->string('gambar')->nullable();
            $table->string('penulis')->default('Admin');
            $table->date('tanggal_publish')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('views')->default(0);
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
