<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete()->after('user_id');
            $table->enum('type', ['shop_for_me', 'self_ship'])->default('shop_for_me')->after('status');
        });

        Schema::table('parcels', function (Blueprint $table) {
            $table->string('description')->nullable()->after('tracking_number');
            $table->string('courier')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['warehouse_id', 'type']);
        });

        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn(['description', 'courier']);
        });
    }
};
