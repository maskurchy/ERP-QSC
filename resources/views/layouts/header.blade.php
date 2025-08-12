<div class="flex items-center justify-between px-4 py-3">
    <!-- Mobile menu button -->
    <div class="md:hidden">
        <button type="button" onclick="toggleMobileMenu()" 
                class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Page title -->
    <div class="flex-1 md:flex-none">
        <h1 class="text-lg font-semibold text-gray-900">
            @yield('page-title', 'ড্যাশবোর্ড')
        </h1>
    </div>

    <!-- Right side items -->
    <div class="flex items-center space-x-4">
        
        <!-- Notifications -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                    class="p-2 text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 relative">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.5a6 6 0 0 1 6 6v2l1.5 1.5v1h-13v-1L6.5 11.5v-2a6 6 0 0 1 6-6z"></path>
                </svg>
                <!-- Notification badge -->
                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
            </button>
            
            <!-- Notification dropdown -->
            <div x-show="open" @click.away="open = false" 
                 class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                <div class="py-2">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <h3 class="text-sm font-medium text-gray-900">বিজ্ঞপ্তি</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <!-- Sample notifications -->
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm text-gray-900">নতুন অ্যাপয়েন্টমেন্ট অনুরোধ</p>
                            <p class="text-xs text-gray-500">৫ মিনিট আগে</p>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm text-gray-900">পেমেন্ট সম্পন্ন হয়েছে</p>
                            <p class="text-xs text-gray-500">১০ মিনিট আগে</p>
                        </a>
                    </div>
                    <div class="px-4 py-2 border-t border-gray-200">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-500">সব দেখুন</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User menu -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-medium">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                </div>
                <span class="ml-2 text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                <svg class="ml-1 h-4 w-4 text-gray-500 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <!-- User dropdown -->
            <div x-show="open" @click.away="open = false" 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                <div class="py-1">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        প্রোফাইল সম্পাদনা
                    </a>
                    
                    @if(auth()->user()->hasRole(['super_admin', 'admin']))
                        <a href="{{ route('admin.settings.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            সেটিংস
                        </a>
                    @endif
                    
                    <div class="border-t border-gray-200"></div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            লগআউট
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile menu -->
<div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
    <div class="px-2 pt-2 pb-3 space-y-1">
        @if(auth()->user()->hasRole(['super_admin', 'admin']))
            <a href="{{ route('admin.dashboard') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                ড্যাশবোর্ড
            </a>
            <a href="{{ route('admin.patients.index') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                রোগী ব্যবস্থাপনা
            </a>
            <a href="{{ route('admin.appointments.index') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                অ্যাপয়েন্টমেন্ট
            </a>
        @endif
        
        @if(auth()->user()->hasRole('doctor'))
            <a href="{{ route('doctor.dashboard') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                ড্যাশবোর্ড
            </a>
            <a href="{{ route('doctor.appointments.index') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                আজকের অ্যাপয়েন্টমেন্ট
            </a>
        @endif
        
        @if(auth()->user()->hasRole('receptionist'))
            <a href="{{ route('reception.dashboard') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                ড্যাশবোর্ড
            </a>
            <a href="{{ route('reception.appointments.index') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                অ্যাপয়েন্টমেন্ট ব্যবস্থাপনা
            </a>
        @endif
        
        @if(auth()->user()->hasRole('patient'))
            <a href="{{ route('patient.dashboard') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                ড্যাশবোর্ড
            </a>
            <a href="{{ route('patient.appointments.index') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                নতুন অ্যাপয়েন্টমেন্ট
            </a>
        @endif
    </div>
</div>