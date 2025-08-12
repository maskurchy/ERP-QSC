<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_type',
        'is_active',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'phone', 'user_type', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relationships
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function createdAppointments()
    {
        return $this->hasMany(Appointment::class, 'created_by');
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'doctor_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'doctor_id');
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class, 'recorded_by');
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByUserType($query, $type)
    {
        return $query->where('user_type', $type);
    }

    /**
     * Accessors & Mutators
     */
    public function getIsPatientAttribute()
    {
        return $this->user_type === 'patient';
    }

    public function getIsDoctorAttribute()
    {
        return $this->user_type === 'doctor';
    }

    public function getIsReceptionistAttribute()
    {
        return $this->user_type === 'receptionist';
    }

    public function getIsAdminAttribute()
    {
        return in_array($this->user_type, ['admin', 'super_admin']);
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->user_type === 'super_admin';
    }
}
