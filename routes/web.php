<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\SystemSettingController;

// Public routes
Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Test login route (bypasses CSRF for testing)
Route::get('/test-login/{email}', function ($email) {
    $user = \App\Models\User::where('email', $email)->first();
    if ($user) {
        auth()->login($user);
        return redirect('/dashboard');
    }
    return redirect('/login')->with('error', 'User not found');
})->name('test.login');

// Debug route
Route::get('/debug-user', function () {
    $user = auth()->user();
    if (!$user) {
        return 'No user logged in';
    }
    
    return [
        'user' => $user->toArray(),
        'roles' => $user->roles->pluck('name'),
        'permissions' => $user->permissions->pluck('name'),
        'hasRole_super_admin' => $user->hasRole('super_admin'),
        'hasRole_admin' => $user->hasRole('admin'),
    ];
})->middleware('auth');

// Simple test dashboard without middleware
Route::get('/simple-dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return 'No user logged in';
    }
    
    return view('admin.dashboard', [
        'stats' => [
            'total_patients' => 0,
            'today_appointments' => 0,
            'pending_appointments' => 0,
            'monthly_revenue' => 0,
        ],
        'recentAppointments' => collect(),
        'monthlyStats' => [
            'months' => [],
            'appointments' => [],
            'revenue' => []
        ]
    ]);
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin routes
    Route::middleware(['role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('settings', SystemSettingController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('appointments', AppointmentController::class);
    });
    
    // Doctor routes
    Route::middleware(['role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', AppointmentController::class);
        Route::resource('patients', PatientController::class);
    });
    
    // Receptionist routes
    Route::middleware(['role:receptionist'])->prefix('reception')->name('reception.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', AppointmentController::class);
        Route::resource('patients', PatientController::class);
    });
    
    // Patient routes
    Route::middleware(['role:patient'])->prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', AppointmentController::class);
        Route::get('/profile', [PatientController::class, 'profile'])->name('profile');
        Route::get('/profile/create', [PatientController::class, 'createProfile'])->name('profile.create');
        Route::post('/profile', [PatientController::class, 'storeProfile'])->name('profile.store');
    });
    
    // Common routes for all authenticated users
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
});

// API routes for mobile app and AJAX requests
Route::prefix('api')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function () {
        return auth()->user();
    });
    
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('appointments', AppointmentController::class);
});
