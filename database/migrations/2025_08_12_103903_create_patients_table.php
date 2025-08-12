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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('patient_id')->unique(); // Auto-generated patient ID
            $table->string('full_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('nid_number')->nullable(); // Encrypted
            $table->string('phone_primary');
            $table->string('phone_secondary')->nullable();
            $table->text('address_present')->nullable();
            $table->text('address_permanent')->nullable();
            $table->string('occupation')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('current_medications')->nullable();
            $table->text('allergies')->nullable();
            $table->json('problem_categories')->nullable(); // Array of selected problems
            $table->text('problem_description')->nullable();
            $table->json('uploaded_images')->nullable(); // Array of image paths
            $table->string('qr_code')->nullable(); // QR code for quick identification
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->timestamp('last_visit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
