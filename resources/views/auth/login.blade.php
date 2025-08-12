@extends('layouts.app')

@section('title', 'লগইন - ' . $centerName)

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            @if($centerLogo)
                <img class="mx-auto h-20 w-auto" src="{{ asset('storage/' . $centerLogo) }}" alt="{{ $centerName }}">
            @else
                <div class="mx-auto h-20 w-20 bg-blue-600 rounded-full flex items-center justify-center">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                    </svg>
                </div>
            @endif
            
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                {{ $centerName }}
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                ম্যানেজমেন্ট সিস্টেমে স্বাগতম
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div>
                    <label for="email" class="form-label">
                        ইমেইল ঠিকানা
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="form-input @error('email') border-red-500 @enderror" 
                           placeholder="আপনার ইমেইল ঠিকানা লিখুন"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="form-label">
                        পাসওয়ার্ড
                    </label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="form-input @error('password') border-red-500 @enderror" 
                           placeholder="আপনার পাসওয়ার্ড লিখুন">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            আমাকে মনে রাখুন
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            পাসওয়ার্ড ভুলে গেছেন?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full btn-primary">
                        লগইন করুন
                    </button>
                </div>
            </form>
            
            <!-- Test User Credentials -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-900 mb-4">পরীক্ষার জন্য ব্যবহারকারী:</h3>
                <div class="grid grid-cols-1 gap-3 text-xs">
                    <div class="bg-gray-50 p-3 rounded">
                        <strong>সুপার অ্যাডমিন:</strong><br>
                        ইমেইল: superadmin@app.com<br>
                        পাসওয়ার্ড: password
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <strong>রিসেপশনিস্ট:</strong><br>
                        ইমেইল: reception@app.com<br>
                        পাসওয়ার্ড: password
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <strong>ডাক্তার:</strong><br>
                        ইমেইল: doctor@app.com<br>
                        পাসওয়ার্ড: password
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <strong>রোগী:</strong><br>
                        ইমেইল: patient@app.com<br>
                        পাসওয়ার্ড: password
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection