<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@app.com'],
            [
                'name' => 'Super Administrator',
                'phone' => '+880-1700000001',
                'password' => Hash::make('password'),
                'user_type' => 'super_admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super_admin');

        // Create employee record for super admin
        Employee::firstOrCreate(
            ['user_id' => $superAdmin->id],
            [
                'employee_id' => 'EMP001',
                'full_name' => 'Super Administrator',
                'designation' => 'Super Administrator',
                'department' => 'Administration',
                'phone_primary' => '+880-1700000001',
                'joining_date' => now()->subYear(),
                'basic_salary' => 50000,
                'employment_status' => 'active',
            ]
        );

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@app.com'],
            [
                'name' => 'Administrator',
                'phone' => '+880-1700000002',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        Employee::firstOrCreate(
            ['user_id' => $admin->id],
            [
                'employee_id' => 'EMP002',
                'full_name' => 'Administrator',
                'designation' => 'Administrator',
                'department' => 'Administration',
                'phone_primary' => '+880-1700000002',
                'joining_date' => now()->subMonths(6),
                'basic_salary' => 40000,
                'employment_status' => 'active',
            ]
        );

        // Doctor
        $doctor = User::firstOrCreate(
            ['email' => 'doctor@app.com'],
            [
                'name' => 'ডাক্তার মোহাম্মদ আলী',
                'phone' => '+880-1700000003',
                'password' => Hash::make('password'),
                'user_type' => 'doctor',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $doctor->assignRole('doctor');

        Employee::firstOrCreate(
            ['user_id' => $doctor->id],
            [
                'employee_id' => 'DOC001',
                'full_name' => 'ডাক্তার মোহাম্মদ আলী',
                'designation' => 'রুকইয়াহ বিশেষজ্ঞ',
                'department' => 'Medical',
                'phone_primary' => '+880-1700000003',
                'joining_date' => now()->subMonths(3),
                'basic_salary' => 60000,
                'employment_status' => 'active',
                'qualifications' => 'এমবিবিএস, ইসলামিক স্টাডিজে স্নাতকোত্তর',
                'experience' => '১০ বছরের রুকইয়াহ অভিজ্ঞতা',
            ]
        );

        // Receptionist
        $receptionist = User::firstOrCreate(
            ['email' => 'reception@app.com'],
            [
                'name' => 'রিসেপশনিস্ট ফাতিমা',
                'phone' => '+880-1700000004',
                'password' => Hash::make('password'),
                'user_type' => 'receptionist',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $receptionist->assignRole('receptionist');

        Employee::firstOrCreate(
            ['user_id' => $receptionist->id],
            [
                'employee_id' => 'REC001',
                'full_name' => 'রিসেপশনিস্ট ফাতিমা',
                'designation' => 'রিসেপশনিস্ট',
                'department' => 'Front Desk',
                'phone_primary' => '+880-1700000004',
                'joining_date' => now()->subMonths(2),
                'basic_salary' => 25000,
                'employment_status' => 'active',
            ]
        );

        // Sample Patient
        $patient = User::firstOrCreate(
            ['email' => 'patient@app.com'],
            [
                'name' => 'রোগী আব্দুল করিম',
                'phone' => '+880-1700000005',
                'password' => Hash::make('password'),
                'user_type' => 'patient',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $patient->assignRole('patient');

        Patient::firstOrCreate(
            ['user_id' => $patient->id],
            [
                'patient_id' => 'P2025000001',
                'full_name' => 'আব্দুল করিম',
                'father_name' => 'আব্দুর রহমান',
                'mother_name' => 'রাহেলা খাতুন',
                'date_of_birth' => '1985-05-15',
                'gender' => 'male',
                'phone_primary' => '+880-1700000005',
                'address_present' => 'ঢাকা, বাংলাদেশ',
                'occupation' => 'ব্যবসায়ী',
                'problem_categories' => ['জিন/ভূতের সমস্যা', 'পারিবারিক সমস্যা'],
                'problem_description' => 'পারিবারিক অশান্তি এবং অস্বাভাবিক ঘটনা',
                'status' => 'active',
            ]
        );

        // Accountant
        $accountant = User::firstOrCreate(
            ['email' => 'accountant@app.com'],
            [
                'name' => 'হিসাবরক্ষক আহমেদ',
                'phone' => '+880-1700000006',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $accountant->assignRole('accountant');

        Employee::firstOrCreate(
            ['user_id' => $accountant->id],
            [
                'employee_id' => 'ACC001',
                'full_name' => 'হিসাবরক্ষক আহমেদ',
                'designation' => 'হিসাবরক্ষক',
                'department' => 'Finance',
                'phone_primary' => '+880-1700000006',
                'joining_date' => now()->subMonths(4),
                'basic_salary' => 35000,
                'employment_status' => 'active',
                'qualifications' => 'বিকম (অনার্স), এমকম',
            ]
        );
    }
}
