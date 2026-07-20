<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_donasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('deskripsi_lengkap')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('id_kategori')->constrained('kategori_programs')->onDelete('cascade');
            $table->bigInteger('target_dana')->default(0);
            $table->bigInteger('dana_terkumpul')->default(0);
            $table->integer('penerima')->default(0);
            $table->integer('jumlah_donatur')->default(0);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->string('penulis')->default('Admin');
            $table->enum('status', ['Aktif', 'Selesai', 'Ditutup'])->default('Aktif');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_donasis');
    }
};
