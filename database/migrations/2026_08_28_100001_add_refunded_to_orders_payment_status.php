<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE orders MODIFY payment_status ENUM('pending','paid','failed','refunded') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("UPDATE orders SET payment_status = 'failed' WHERE payment_status = 'refunded'");
            DB::statement("ALTER TABLE orders MODIFY payment_status ENUM('pending','paid','failed') DEFAULT 'pending'");
        }
    }
};
