<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('pan_number')->nullable()->after('business_address');
            $table->string('pan_document')->nullable()->after('pan_number'); // storage path to uploaded PAN certificate/photo
        });
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['pan_number', 'pan_document']);
        });
    }
};