<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Patient Management
            'view_patients',
            'create_patients',
            'edit_patients',
            'delete_patients',
            'view_patient_details',
            
            // Appointment Management
            'view_appointments',
            'create_appointments',
            'edit_appointments',
            'delete_appointments',
            'confirm_appointments',
            'manage_appointment_queue',
            
            // Medical Records
            'view_medical_records',
            'create_diagnoses',
            'edit_diagnoses',
            'view_prescriptions',
            'create_prescriptions',
            'edit_prescriptions',
            
            // Financial Management
            'view_financial_reports',
            'manage_transactions',
            'view_expenses',
            'create_expenses',
            'approve_expenses',
            'manage_billing',
            
            // Inventory Management
            'view_inventory',
            'manage_inventory',
            'view_stock_reports',
            'manage_suppliers',
            
            // Employee Management
            'view_employees',
            'create_employees',
            'edit_employees',
            'delete_employees',
            'manage_payroll',
            
            // System Administration
            'manage_system_settings',
            'manage_users',
            'manage_roles',
            'view_system_logs',
            'manage_backups',
            'manage_integrations',
            
            // Reports
            'view_patient_reports',
            'view_appointment_reports',
            'view_financial_reports',
            'view_inventory_reports',
            'export_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - Full access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - Most permissions except super admin functions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = Permission::whereNotIn('name', [
            'manage_system_settings',
            'manage_roles',
            'manage_backups',
        ])->get();
        $admin->givePermissionTo($adminPermissions);

        // Doctor - Medical and patient related permissions
        $doctor = Role::firstOrCreate(['name' => 'doctor']);
        $doctor->givePermissionTo([
            'view_patients',
            'view_patient_details',
            'view_appointments',
            'edit_appointments',
            'manage_appointment_queue',
            'view_medical_records',
            'create_diagnoses',
            'edit_diagnoses',
            'view_prescriptions',
            'create_prescriptions',
            'edit_prescriptions',
            'view_inventory',
            'view_patient_reports',
        ]);

        // Receptionist - Front desk operations
        $receptionist = Role::firstOrCreate(['name' => 'receptionist']);
        $receptionist->givePermissionTo([
            'view_patients',
            'create_patients',
            'edit_patients',
            'view_patient_details',
            'view_appointments',
            'create_appointments',
            'edit_appointments',
            'confirm_appointments',
            'manage_appointment_queue',
            'manage_billing',
            'manage_transactions',
            'view_inventory',
        ]);

        // Patient - Limited self-service permissions
        $patient = Role::firstOrCreate(['name' => 'patient']);
        $patient->givePermissionTo([
            'view_appointments',
            'create_appointments',
            'view_medical_records',
            'view_prescriptions',
        ]);

        // Accountant - Financial permissions
        $accountant = Role::firstOrCreate(['name' => 'accountant']);
        $accountant->givePermissionTo([
            'view_financial_reports',
            'manage_transactions',
            'view_expenses',
            'create_expenses',
            'approve_expenses',
            'manage_billing',
            'view_employees',
            'manage_payroll',
            'export_reports',
        ]);
    }
}
