<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->string('tracking_number')->unique();
            $table->decimal('weight', 8, 2)->nullable()->comment('kg');
            $table->decimal('length', 8, 2)->nullable()->comment('cm');
            $table->decimal('width', 8, 2)->nullable()->comment('cm');
            $table->decimal('height', 8, 2)->nullable()->comment('cm');
            $table->string('condition')->nullable();
            $table->enum('status', [
                'arrived',
                'stored',
                'ready_for_shipment',
                'shipped',
                'delivered',
            ])->default('arrived');
            $table->date('arrival_date')->nullable();
            $table->timestamp('storage_started_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
