<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->decimal('total_sales', 10, 2);
            $table->decimal('commission_deducted', 10, 2);
            $table->decimal('payout_amount', 10, 2);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->date('period_start');
            $table->date('period_end');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_payouts');
    }
};