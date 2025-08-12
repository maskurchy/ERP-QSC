<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'center_name',
                'value' => 'রুকইয়াহ সেন্টার',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Center Name',
                'description' => 'Name of the Ruqyah center',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'center_name_english',
                'value' => 'Ruqyah Center',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Center Name (English)',
                'description' => 'English name of the center',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'center_address',
                'value' => 'ঢাকা, বাংলাদেশ',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Center Address',
                'description' => 'Physical address of the center',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'center_phone',
                'value' => '+880-1234567890',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Center Phone',
                'description' => 'Primary contact number',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'center_email',
                'value' => 'info@ruqyahcenter.com',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Center Email',
                'description' => 'Primary email address',
                'is_public' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'center_logo',
                'value' => null,
                'type' => 'file',
                'group' => 'general',
                'label' => 'Center Logo',
                'description' => 'Logo image for the center',
                'is_public' => true,
                'sort_order' => 6,
            ],

            // Appointment Settings
            [
                'key' => 'daily_appointment_limit',
                'value' => '50',
                'type' => 'number',
                'group' => 'appointment',
                'label' => 'Daily Appointment Limit',
                'description' => 'Maximum number of appointments per day',
                'sort_order' => 1,
            ],
            [
                'key' => 'appointment_duration',
                'value' => '30',
                'type' => 'number',
                'group' => 'appointment',
                'label' => 'Appointment Duration (minutes)',
                'description' => 'Default duration for each appointment',
                'sort_order' => 2,
            ],
            [
                'key' => 'working_days',
                'value' => '["sunday","monday","tuesday","wednesday","thursday"]',
                'type' => 'json',
                'group' => 'appointment',
                'label' => 'Working Days',
                'description' => 'Days when the center is open',
                'sort_order' => 3,
            ],
            [
                'key' => 'working_hours_start',
                'value' => '09:00',
                'type' => 'text',
                'group' => 'appointment',
                'label' => 'Working Hours Start',
                'description' => 'Daily opening time',
                'sort_order' => 4,
            ],
            [
                'key' => 'working_hours_end',
                'value' => '17:00',
                'type' => 'text',
                'group' => 'appointment',
                'label' => 'Working Hours End',
                'description' => 'Daily closing time',
                'sort_order' => 5,
            ],
            [
                'key' => 'advance_booking_days',
                'value' => '30',
                'type' => 'number',
                'group' => 'appointment',
                'label' => 'Advance Booking Days',
                'description' => 'How many days in advance can patients book',
                'sort_order' => 6,
            ],

            // Financial Settings
            [
                'key' => 'default_consultation_fee',
                'value' => '500',
                'type' => 'number',
                'group' => 'financial',
                'label' => 'Default Consultation Fee (BDT)',
                'description' => 'Standard consultation fee',
                'sort_order' => 1,
            ],
            [
                'key' => 'currency_symbol',
                'value' => '৳',
                'type' => 'text',
                'group' => 'financial',
                'label' => 'Currency Symbol',
                'description' => 'Symbol for currency display',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'accept_donations',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'financial',
                'label' => 'Accept Donations',
                'description' => 'Whether to accept donations/sadaqah',
                'sort_order' => 3,
            ],
            [
                'key' => 'payment_methods',
                'value' => '["cash","bkash","nagad","rocket"]',
                'type' => 'json',
                'group' => 'financial',
                'label' => 'Accepted Payment Methods',
                'description' => 'List of accepted payment methods',
                'sort_order' => 4,
            ],

            // Notification Settings
            [
                'key' => 'sms_notifications_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'notification',
                'label' => 'SMS Notifications Enabled',
                'description' => 'Enable SMS notifications',
                'sort_order' => 1,
            ],
            [
                'key' => 'email_notifications_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'notification',
                'label' => 'Email Notifications Enabled',
                'description' => 'Enable email notifications',
                'sort_order' => 2,
            ],
            [
                'key' => 'appointment_reminder_hours',
                'value' => '24',
                'type' => 'number',
                'group' => 'notification',
                'label' => 'Appointment Reminder (hours before)',
                'description' => 'Send reminder this many hours before appointment',
                'sort_order' => 3,
            ],

            // Problem Categories
            [
                'key' => 'problem_categories',
                'value' => '["জিন/ভূতের সমস্যা","কালো জাদু","বদনজর","পারিবারিক সমস্যা","ব্যবসায়িক সমস্যা","স্বাস্থ্য সমস্যা","মানসিক সমস্যা","অন্যান্য"]',
                'type' => 'json',
                'group' => 'medical',
                'label' => 'Problem Categories',
                'description' => 'Available problem categories for patients',
                'sort_order' => 1,
            ],
            [
                'key' => 'diagnosis_categories',
                'value' => '["জিন সংক্রান্ত","জাদু সংক্রান্ত","বদনজর","মানসিক","শারীরিক","পারিবারিক","আধ্যাত্মিক","অন্যান্য"]',
                'type' => 'json',
                'group' => 'medical',
                'label' => 'Diagnosis Categories',
                'description' => 'Available diagnosis categories',
                'sort_order' => 2,
            ],

            // System Settings
            [
                'key' => 'system_timezone',
                'value' => 'Asia/Dhaka',
                'type' => 'text',
                'group' => 'system',
                'label' => 'System Timezone',
                'description' => 'Default timezone for the system',
                'sort_order' => 1,
            ],
            [
                'key' => 'system_language',
                'value' => 'bn',
                'type' => 'text',
                'group' => 'system',
                'label' => 'System Language',
                'description' => 'Default language (bn for Bengali, en for English)',
                'sort_order' => 2,
            ],
            [
                'key' => 'auto_backup_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'system',
                'label' => 'Auto Backup Enabled',
                'description' => 'Enable automatic database backups',
                'sort_order' => 3,
            ],
            [
                'key' => 'backup_frequency',
                'value' => 'daily',
                'type' => 'text',
                'group' => 'system',
                'label' => 'Backup Frequency',
                'description' => 'How often to backup (daily, weekly, monthly)',
                'sort_order' => 4,
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
