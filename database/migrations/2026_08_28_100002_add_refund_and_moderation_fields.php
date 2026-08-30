<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('refund_amount', 10, 2)->nullable()->after('gateway_ref');
            $table->text('refund_reason')->nullable()->after('refund_amount');
            $table->timestamp('refunded_at')->nullable()->after('refund_reason');
            $table->foreignId('refunded_by')->nullable()->after('refunded_at')
                ->constrained('users')->onDelete('set null');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false)->after('stock');
            $table->text('hidden_reason')->nullable()->after('is_hidden');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->foreignId('reviewed_by')->nullable()->after('approved_at')
                ->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropConstrainedForeignId('reviewed_by');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_hidden', 'hidden_reason']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('refunded_by');
            $table->dropColumn(['refund_amount', 'refund_reason', 'refunded_at']);
        });
    }
};
