<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->text('admin_note')->nullable()->after('confirmed_at');
            $table->foreignId('confirmed_by')->nullable()->after('admin_note')->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn(['admin_note', 'confirmed_by']);
        });
    }
};
