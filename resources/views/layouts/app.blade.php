<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'রুকইয়াহ সেন্টার ম্যানেজমেন্ট সিস্টেম')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
        
        .mobile-first {
            @apply min-h-screen bg-gray-50;
        }
        
        .app-header {
            @apply bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50;
        }
        
        .sidebar {
            @apply bg-white shadow-lg border-r border-gray-200 h-full;
        }
        
        .main-content {
            @apply flex-1 overflow-auto;
        }
        
        .card {
            @apply bg-white rounded-lg shadow-sm border border-gray-200 p-6;
        }
        
        .btn-primary {
            @apply bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200;
        }
        
        .btn-secondary {
            @apply bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200;
        }
        
        .btn-success {
            @apply bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200;
        }
        
        .btn-danger {
            @apply bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200;
        }
        
        .form-input {
            @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent;
        }
        
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }
        
        .stat-card {
            @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-6 shadow-lg;
        }
        
        .mobile-nav {
            @apply fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 md:hidden;
        }
        
        @media (max-width: 768px) {
            .desktop-sidebar {
                @apply hidden;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="mobile-first">
    <div id="app" class="flex flex-col md:flex-row min-h-screen">
        
        @auth
            <!-- Desktop Sidebar -->
            <div class="desktop-sidebar w-64 flex-shrink-0">
                @include('layouts.sidebar')
            </div>
        @endauth
        
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            
            @auth
                <!-- Header -->
                <header class="app-header">
                    @include('layouts.header')
                </header>
            @endauth
            
            <!-- Page Content -->
            <main class="main-content p-4 md:p-6 pb-20 md:pb-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
            
        </div>
        
        @auth
            <!-- Mobile Navigation -->
            <nav class="mobile-nav">
                @include('layouts.mobile-nav')
            </nav>
        @endauth
        
    </div>
    
    <!-- Scripts -->
    <script>
        // CSRF Token for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
        
        // Set CSRF token for all AJAX requests
        if (window.axios) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
        }
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>