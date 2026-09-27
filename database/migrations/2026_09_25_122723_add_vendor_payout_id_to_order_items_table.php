<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Without this link, generating a payout twice for overlapping dates
     * would pay a vendor for the same delivered order twice. Marking each
     * order_item as "settled" in a specific payout is what makes payout
     * generation safe to run repeatedly.
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('vendor_payout_id')->nullable()->after('vendor_id')
                ->constrained('vendor_payouts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('vendor_payout_id');
        });
    }
};