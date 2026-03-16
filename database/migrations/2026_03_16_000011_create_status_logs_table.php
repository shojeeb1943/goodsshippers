<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('loggable'); // loggable_type, loggable_id
            $table->string('status');
            $table->text('note')->nullable();
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['loggable_type', 'loggable_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_logs');
    }
};
