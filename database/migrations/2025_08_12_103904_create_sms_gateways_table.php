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
        Schema::create('sms_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('provider'); // ssl_wireless, bulk_sms_bd, etc.
            $table->string('api_url');
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->json('additional_params')->nullable(); // For extra parameters
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
            $table->decimal('cost_per_sms', 8, 4)->default(0);
            $table->integer('daily_limit')->nullable();
            $table->integer('monthly_limit')->nullable();
            $table->integer('sms_sent_today')->default(0);
            $table->integer('sms_sent_this_month')->default(0);
            $table->date('last_reset_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_gateways');
    }
};
