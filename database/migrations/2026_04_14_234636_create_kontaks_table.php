<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('hero_badge')->default('HUBUNGI KAMI');
            $table->string('hero_title_first')->default('Mari');
            $table->string('hero_title_highlight')->default('Terhubung Dengan Kami');
            $table->text('hero_description');

            // Kantor Pusat
            $table->string('office_address')->nullable();
            $table->string('office_map_link')->nullable();

            // Telepon
            $table->string('phone_kantor')->nullable();
            $table->string('phone_hotline')->nullable();
            $table->string('phone_darurat')->nullable();

            // Email
            $table->string('email_umum')->nullable();
            $table->string('email_donasi')->nullable();
            $table->string('email_humas')->nullable();

            // Media Sosial
            $table->string('social_facebook')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_linkedin')->nullable();

            // WhatsApp
            $table->string('whatsapp_number')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
