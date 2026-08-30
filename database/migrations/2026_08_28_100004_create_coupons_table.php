<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percent', 'fixed']);
            $table->decimal('value', 10, 2);
            $table->decimal('min_order_total', 10, 2)->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('times_used')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->after('subtotal')
                ->constrained('coupons')->onDelete('set null');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('coupon_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('coupon_id');
            $table->dropColumn('discount_amount');
        });

        Schema::dropIfExists('coupons');
    }
};
