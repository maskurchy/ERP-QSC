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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->enum('type', ['income', 'expense']);
            $table->enum('category', ['consultation_fee', 'medication', 'treatment', 'donation', 'sadaqah', 'salary', 'utility', 'maintenance', 'other']);
            $table->decimal('amount', 12, 2);
            $table->text('description');
            $table->foreignId('patient_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('payment_method')->nullable(); // cash, bkash, nagad, rocket, bank_transfer
            $table->string('payment_reference')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('receipt_file')->nullable(); // For uploaded receipts
            $table->date('transaction_date');
            $table->foreignId('recorded_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
