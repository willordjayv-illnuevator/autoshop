<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_service_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shop_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('service_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('is_enabled')->default(true);

            // optional override per shop
            $table->integer('custom_interval_days')->nullable();

            $table->timestamps();

            // prevent duplicate assignment per shop
            $table->unique(['shop_id', 'service_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_service_types');
    }
};
