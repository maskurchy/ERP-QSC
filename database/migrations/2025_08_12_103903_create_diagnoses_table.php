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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->string('diagnosis_code')->nullable();
            $table->string('diagnosis_category');
            $table->text('primary_diagnosis');
            $table->text('secondary_diagnosis')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('examination_findings')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('follow_up_instructions')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->enum('severity', ['mild', 'moderate', 'severe', 'critical'])->default('mild');
            $table->enum('status', ['active', 'resolved', 'chronic', 'follow_up_required'])->default('active');
            $table->text('doctor_notes')->nullable();
            $table->json('vital_signs')->nullable(); // Blood pressure, temperature, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
