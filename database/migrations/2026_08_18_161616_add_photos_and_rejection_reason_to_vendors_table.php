<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            // Sample product photos submitted with the application — stored as
            // a JSON array of storage paths. Reviewed by admin before approval.
            $table->json('sample_product_photos')->nullable()->after('logo');
            $table->text('rejection_reason')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['sample_product_photos', 'rejection_reason']);
        });
    }
};