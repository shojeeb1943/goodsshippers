<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shipping_mode_id')->constrained()->cascadeOnDelete();
            $table->string('shipment_number')->unique();
            $table->enum('status', [
                'created',
                'in_transit',
                'customs_clearance',
                'out_for_delivery',
                'delivered',
            ])->default('created');
            $table->decimal('actual_weight', 8, 2)->nullable()->comment('kg');
            $table->decimal('volumetric_weight', 8, 2)->nullable()->comment('kg');
            $table->decimal('chargeable_weight', 8, 2)->nullable()->comment('kg');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
