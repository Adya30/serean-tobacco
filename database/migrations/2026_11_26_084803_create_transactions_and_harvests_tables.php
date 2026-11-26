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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice_code')->unique();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->unsignedInteger('total_weight_kg');
            $table->unsignedBigInteger('total_price');
            $table->string('fleet_type'); // 'pick_up' (<300 kg) atau 'tambahan_armada' (>=300 kg)
            $table->string('fleet_name');
            $table->string('shipping_status')->default('menunggu_konfirmasi'); // menunggu_konfirmasi, diproses, dalam_pengiriman, terkirim, dibatalkan
            $table->string('payment_status')->default('menunggu_pembayaran'); // menunggu_pembayaran, lunas, dibatalkan
            $table->string('tracking_number')->nullable();
            $table->text('tracking_notes')->nullable();
            $table->string('estimated_delivery')->nullable();
            $table->timestamps();
        });

        Schema::create('transaction_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->foreignUuid('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('product_name');
            $table->string('variety');
            $table->string('grade')->nullable();
            $table->unsignedInteger('quantity_kg');
            $table->unsignedInteger('price_per_kg');
            $table->unsignedBigInteger('subtotal');
            $table->timestamps();
        });

        Schema::create('harvests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('farmer_id')->constrained('users')->cascadeOnDelete();
            $table->string('farmer_name');
            $table->string('variety');
            $table->string('grade');
            $table->unsignedInteger('harvest_weight_kg');
            $table->string('moisture_content')->default('12–14%');
            $table->date('harvest_date');
            $table->string('farm_location');
            $table->text('quality_notes')->nullable();
            $table->string('status')->default('diterima_gudang'); // diterima_gudang, proses_curing, siap_distribusi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvests');
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transactions');
    }
};
