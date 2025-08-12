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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('provider'); // bkash, nagad, rocket, ssl_commerz, etc.
            $table->string('gateway_type'); // mobile_banking, card, bank_transfer
            $table->string('api_url')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_key')->nullable();
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('app_key')->nullable();
            $table->string('app_secret')->nullable();
            $table->json('additional_config')->nullable(); // For extra configuration
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_sandbox')->default(true);
            $table->decimal('transaction_fee_percentage', 5, 2)->default(0);
            $table->decimal('transaction_fee_fixed', 10, 2)->default(0);
            $table->decimal('minimum_amount', 10, 2)->default(0);
            $table->decimal('maximum_amount', 12, 2)->nullable();
            $table->json('supported_currencies')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->string('logo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
