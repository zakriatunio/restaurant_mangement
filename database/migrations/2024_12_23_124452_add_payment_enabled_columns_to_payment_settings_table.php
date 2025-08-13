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
        Schema::table('payment_gateway_credentials', function (Blueprint $table) {
            $table->boolean('is_dine_in_payment_enabled')->default(false);
            $table->boolean('is_delivery_payment_enabled')->default(false);
            $table->boolean('is_pickup_payment_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_gateway_credentials', function (Blueprint $table) {
            $table->dropColumn([
                'is_dine_in_payment_enabled',
                'is_delivery_payment_enabled',
                'is_pickup_payment_enabled'
            ]);
        });
    }
};
