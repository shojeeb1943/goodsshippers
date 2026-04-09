<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Alter the enum to add 'delivered' status
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'product_requested',
            'quote_sent',
            'quote_approved',
            'quote_rejected',
            'order_purchased',
            'delivered',
            'cancelled'
        ) NOT NULL DEFAULT 'product_requested'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'product_requested',
            'quote_sent',
            'quote_approved',
            'quote_rejected',
            'order_purchased',
            'cancelled'
        ) NOT NULL DEFAULT 'product_requested'");
    }
};
