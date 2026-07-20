<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Platform Donasi Terpercaya');
            $table->string('title_first')->default('Bersama Wujudkan');
            $table->string('title_highlight')->default('Energi Bahagia');
            $table->string('title_last')->default('untuk Semua');
            $table->text('description');
            $table->string('button_primary_text')->default('Mulai Donasi');
            $table->string('button_primary_link')->default('/program');
            $table->string('button_secondary_text')->default('Pelajari');
            $table->string('button_secondary_link')->default('/profile');
            $table->string('hero_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
