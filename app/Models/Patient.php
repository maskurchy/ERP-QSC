<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'patient_id',
        'full_name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'gender',
        'nid_number',
        'phone_primary',
        'phone_secondary',
        'address_present',
        'address_permanent',
        'occupation',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'medical_history',
        'current_medications',
        'allergies',
        'problem_categories',
        'problem_description',
        'uploaded_images',
        'qr_code',
        'status',
        'last_visit',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'problem_categories' => 'array',
        'uploaded_images' => 'array',
        'last_visit' => 'datetime',
    ];

    /**
     * Activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['full_name', 'phone_primary', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Boot method to auto-generate patient ID and QR code
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            if (empty($patient->patient_id)) {
                $patient->patient_id = 'P' . date('Y') . str_pad(static::count() + 1, 6, '0', STR_PAD_LEFT);
            }
            
            if (empty($patient->qr_code)) {
                $patient->qr_code = Str::random(32);
            }
        });
    }

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Accessors & Mutators
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getFullAddressAttribute()
    {
        return $this->address_present ?: $this->address_permanent;
    }

    public function setNidNumberAttribute($value)
    {
        $this->attributes['nid_number'] = $value ? encrypt($value) : null;
    }

    public function getNidNumberAttribute($value)
    {
        return $value ? decrypt($value) : null;
    }
}
