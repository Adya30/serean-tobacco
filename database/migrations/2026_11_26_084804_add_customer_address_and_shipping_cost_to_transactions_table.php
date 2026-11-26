<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('kabupaten')->nullable()->after('customer_address');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('desa')->nullable()->after('kecamatan');
            $table->unsignedBigInteger('items_subtotal')->default(0)->after('total_weight_kg');
            $table->unsignedBigInteger('shipping_cost')->default(0)->after('items_subtotal');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('kabupaten')->nullable()->after('address');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('desa')->nullable()->after('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['desa', 'kecamatan', 'kabupaten']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['shipping_cost', 'items_subtotal', 'desa', 'kecamatan', 'kabupaten']);
        });
    }
};
