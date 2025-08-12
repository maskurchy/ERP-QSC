<div class="sidebar h-full flex flex-col">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center">
            <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h1 class="text-lg font-semibold text-gray-900">রুকইয়াহ সেন্টার</h1>
                <p class="text-sm text-gray-500">ম্যানেজমেন্ট সিস্টেম</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        
        @if(auth()->user()->hasRole(['super_admin', 'admin']))
            <!-- Admin Navigation -->
            <div class="space-y-1">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">প্রশাসন</h3>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    ড্যাশবোর্ড
                </a>
                
                <a href="{{ route('admin.patients.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    রোগী ব্যবস্থাপনা
                </a>
                
                <a href="{{ route('admin.appointments.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    অ্যাপয়েন্টমেন্ট
                </a>
                
                @if(auth()->user()->hasRole('super_admin'))
                    <a href="{{ route('admin.settings.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        সিস্টেম সেটিংস
                    </a>
                @endif
            </div>
        @endif
        
        @if(auth()->user()->hasRole('doctor'))
            <!-- Doctor Navigation -->
            <div class="space-y-1">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">চিকিৎসা</h3>
                
                <a href="{{ route('doctor.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    ড্যাশবোর্ড
                </a>
                
                <a href="{{ route('doctor.appointments.index') }}" 
                   class="nav-link {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    আজকের অ্যাপয়েন্টমেন্ট
                </a>
                
                <a href="{{ route('doctor.patients.index') }}" 
                   class="nav-link {{ request()->routeIs('doctor.patients.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"></path>
                    </svg>
                    রোগীর তালিকা
                </a>
            </div>
        @endif
        
        @if(auth()->user()->hasRole('receptionist'))
            <!-- Receptionist Navigation -->
            <div class="space-y-1">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">রিসেপশন</h3>
                
                <a href="{{ route('reception.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('reception.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    ড্যাশবোর্ড
                </a>
                
                <a href="{{ route('reception.appointments.index') }}" 
                   class="nav-link {{ request()->routeIs('reception.appointments.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    অ্যাপয়েন্টমেন্ট ব্যবস্থাপনা
                </a>
                
                <a href="{{ route('reception.patients.index') }}" 
                   class="nav-link {{ request()->routeIs('reception.patients.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    নতুন রোগী নিবন্ধন
                </a>
            </div>
        @endif
        
        @if(auth()->user()->hasRole('patient'))
            <!-- Patient Navigation -->
            <div class="space-y-1">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">রোগী সেবা</h3>
                
                <a href="{{ route('patient.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    ড্যাশবোর্ড
                </a>
                
                <a href="{{ route('patient.appointments.index') }}" 
                   class="nav-link {{ request()->routeIs('patient.appointments.*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    নতুন অ্যাপয়েন্টমেন্ট
                </a>
                
                <a href="{{ route('patient.profile') }}" 
                   class="nav-link {{ request()->routeIs('patient.profile*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    আমার প্রোফাইল
                </a>
            </div>
        @endif
        
    </nav>

    <!-- User Info -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center">
            <div class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center">
                <span class="text-white text-sm font-medium">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </span>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500 truncate">
                    {{ ucfirst(str_replace('_', ' ', auth()->user()->user_type)) }}
                </p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                লগআউট
            </button>
        </form>
    </div>
</div>

<style>
.nav-link {
    @apply flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200;
}

.nav-link.active {
    @apply bg-blue-100 text-blue-700;
}

.nav-icon {
    @apply h-5 w-5 mr-3 flex-shrink-0;
}
</style>