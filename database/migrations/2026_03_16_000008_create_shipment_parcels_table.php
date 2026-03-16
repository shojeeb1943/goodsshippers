<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipment_parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parcel_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['shipment_id', 'parcel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipment_parcels');
    }
};
