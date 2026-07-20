<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable()->default('Tentang Kami');
            $table->string('title_first')->nullable()->default('Tentang');
            $table->string('title_highlight')->nullable()->default('Energi Bahagia');
            $table->text('description')->nullable();
            $table->string('button_primary_text')->nullable()->default('Jelajahi Profil');
            $table->string('button_primary_link')->nullable()->default('#sejarah');
            $table->string('button_secondary_text')->nullable()->default('Hubungi Kami');
            $table->string('button_secondary_link')->nullable()->default('/kontak');
            $table->string('hero_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_heroes');
    }
};
