<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove duplicate product rows (keep the latest) before adding the unique index.
        // This is safe because all products are seeded — there are no user-created products.
        $duplicates = DB::table('products')
            ->select('name', DB::raw('MAX(id) as keep_id'))
            ->groupBy('name')
            ->having(DB::raw('COUNT(*)'), '>', 1)
            ->pluck('keep_id', 'name');

        foreach ($duplicates as $name => $keepId) {
            DB::table('products')
                ->where('name', $name)
                ->where('id', '!=', $keepId)
                ->delete();
        }

        Schema::table('products', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};
