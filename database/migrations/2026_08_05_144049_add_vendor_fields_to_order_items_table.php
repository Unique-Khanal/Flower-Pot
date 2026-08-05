<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->after('product_id')->constrained('vendors')->onDelete('set null');
            $table->enum('vendor_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending')->after('vendor_id');
            $table->decimal('commission_amount', 10, 2)->default(0)->after('subtotal');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['vendor_id', 'vendor_status', 'commission_amount']);
        });
    }
};