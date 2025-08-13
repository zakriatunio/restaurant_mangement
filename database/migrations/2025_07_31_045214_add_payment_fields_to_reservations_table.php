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
        Schema::table('reservations', function (Blueprint $table) {
            // Payment related fields
            $table->decimal('advance_payment_amount', 10, 2)->nullable()->after('special_requests');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending')->after('advance_payment_amount');
            $table->string('payment_method')->nullable()->after('payment_status'); // stripe, razorpay, flutterwave, cash
            $table->string('payment_transaction_id')->nullable()->after('payment_method');
            $table->json('payment_details')->nullable()->after('payment_transaction_id'); // Store gateway response
            $table->timestamp('payment_date')->nullable()->after('payment_details');
            $table->decimal('refund_amount', 10, 2)->nullable()->after('payment_date');
            $table->timestamp('refund_date')->nullable()->after('refund_amount');
            $table->text('payment_notes')->nullable()->after('refund_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'advance_payment_amount',
                'payment_status',
                'payment_method',
                'payment_transaction_id',
                'payment_details',
                'payment_date',
                'refund_amount',
                'refund_date',
                'payment_notes'
            ]);
        });
    }
};
