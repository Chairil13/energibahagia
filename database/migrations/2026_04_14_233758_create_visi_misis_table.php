<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('ARAH & TUJUAN');
            $table->string('title')->default('Visi & Misi');
            $table->text('visi')->nullable();
            $table->json('misi')->nullable(); // Untuk menyimpan array misi
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};
