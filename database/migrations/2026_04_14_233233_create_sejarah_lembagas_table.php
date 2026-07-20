<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarah_lembagas', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('PERJALANAN KAMI');
            $table->string('title')->default('Sejarah Lembaga');
            $table->text('content')->nullable();
            $table->string('institution_name')->default('Yayasan Energi Kebaikan Indonesia');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarah_lembagas');
    }
};
