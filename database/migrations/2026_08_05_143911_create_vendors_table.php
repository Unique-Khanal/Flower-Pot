<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_name');
            $table->string('business_phone');
            $table->text('business_address');
            $table->string('logo')->nullable();
            $table->decimal('commission_rate', 5, 2)->default(10.00);
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};