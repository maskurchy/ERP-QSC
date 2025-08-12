<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\FinancialTransaction;
use App\Models\SystemSetting;
use Carbon\Carbon;

class DashboardController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole(['super_admin', 'admin'])) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('doctor')) {
            return $this->doctorDashboard();
        } elseif ($user->hasRole('receptionist')) {
            return $this->receptionDashboard();
        } elseif ($user->hasRole('patient')) {
            return $this->patientDashboard();
        } else {
            return $this->defaultDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_patients' => Patient::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'monthly_revenue' => FinancialTransaction::where('type', 'income')
                ->whereMonth('transaction_date', now()->month)
                ->sum('amount') ?? 0,
        ];

        $recentAppointments = Appointment::with(['patient', 'doctor'])
            ->latest()
            ->take(10)
            ->get();

        $monthlyStats = $this->getMonthlyStats();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'monthlyStats'));
    }

    private function doctorDashboard()
    {
        $doctor = auth()->user();
        
        $stats = [
            'today_appointments' => Appointment::where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', today())
                ->count(),
            'pending_appointments' => Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'pending')
                ->count(),
            'completed_today' => Appointment::where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', today())
                ->where('status', 'completed')
                ->count(),
            'total_patients' => Appointment::where('doctor_id', $doctor->id)
                ->distinct('patient_id')
                ->count(),
        ];

        $todayAppointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->orderBy('serial_number')
            ->get();

        return view('doctor.dashboard', compact('stats', 'todayAppointments'));
    }

    private function receptionDashboard()
    {
        $stats = [
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
            'pending_confirmations' => Appointment::where('status', 'pending')->count(),
            'checked_in_today' => Appointment::whereDate('appointment_date', today())
                ->whereNotNull('checked_in_at')
                ->count(),
            'new_patients_today' => Patient::whereDate('created_at', today())->count(),
        ];

        $todayAppointments = Appointment::with(['patient', 'doctor'])
            ->whereDate('appointment_date', today())
            ->orderBy('serial_number')
            ->get();

        return view('reception.dashboard', compact('stats', 'todayAppointments'));
    }

    private function patientDashboard()
    {
        $patient = auth()->user()->patient;
        
        if (!$patient) {
            return redirect()->route('patient.profile.create');
        }

        $stats = [
            'total_appointments' => $patient->appointments()->count(),
            'upcoming_appointments' => $patient->appointments()
                ->where('appointment_date', '>=', today())
                ->count(),
            'completed_appointments' => $patient->appointments()
                ->where('status', 'completed')
                ->count(),
            'last_visit' => $patient->last_visit,
        ];

        $recentAppointments = $patient->appointments()
            ->with('doctor')
            ->latest()
            ->take(5)
            ->get();

        $upcomingAppointments = $patient->appointments()
            ->with('doctor')
            ->where('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->take(3)
            ->get();

        return view('patient.dashboard', compact('stats', 'recentAppointments', 'upcomingAppointments', 'patient'));
    }

    private function defaultDashboard()
    {
        return view('dashboard');
    }

    private function getMonthlyStats()
    {
        $months = [];
        $appointments = [];
        $revenue = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $appointments[] = Appointment::whereYear('appointment_date', $date->year)
                ->whereMonth('appointment_date', $date->month)
                ->count();
                
            $revenue[] = FinancialTransaction::where('type', 'income')
                ->whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount');
        }

        return [
            'months' => $months,
            'appointments' => $appointments,
            'revenue' => $revenue,
        ];
    }
}
