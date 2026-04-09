<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('category', ['general', 'shipping', 'billing', 'technical', 'complaint', 'other'])->default('general')->after('user_id');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->after('category');
            $table->text('description')->nullable()->after('subject');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['category', 'priority', 'description']);
        });
    }
};
