<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Админ-панель') - STONEHILL</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/stone-cards.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/admin/sections.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @yield('styles')
    @stack('styles')
    
    <style>
        .admin-container {
            max-width: 1024px;
            margin: 0 auto;
            padding: 0 1rem;
            width: 100%;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Админ-навигация -->
        @include('admin.layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="admin-container py-6">
                <h1 class="text-3xl font-semibold text-gray-900">
                    @yield('header')
                </h1>
            </div>
        </header>

        <!-- Page Content -->
        <main class="py-6">
            <div class="admin-container">
                @yield('content')
            </div>
        </main>
    </div>
    <!-- Сначала основные скрипты -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Потом дополнительные скрипты -->
    @stack('scripts')
</body>
</html>