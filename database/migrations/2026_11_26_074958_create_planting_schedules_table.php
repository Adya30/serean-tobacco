<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planting_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('farmer_name');
            $table->string('variety');
            $table->decimal('land_area_ha', 8, 2)->default(0.5);
            $table->string('location');
            $table->date('planting_date');
            $table->date('estimated_harvest_date');
            $table->unsignedInteger('target_yield_kg')->default(500);
            $table->string('phase')->default('persemaian');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planting_schedules');
    }
};
