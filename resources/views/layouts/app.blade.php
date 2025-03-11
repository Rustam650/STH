<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - StoneHill</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/stone-cards.css') }}">
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --navbar-height: 80px;
                --footer-height: 60px;
            }
            
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                background-color: #1D1D1D;
            }

            #app {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            main {
                flex: 1 0 auto;
            }
            
            /* Стили для сообщений об ошибках */
            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
                width: 100%;
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .alert-error {
                color: #721c24;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }
            
            .alert-success {
                color: #155724;
                background-color: #d4edda;
                border-color: #c3e6cb;
            }
        </style>

        @yield('styles')
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div id="app">
            @include('layouts.navbar')

            <main>
                <!-- Отображение сообщений об ошибках и успешных операциях -->
                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>

        <script src="{{ asset('js/navbar.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            // Мобильное меню
            document.addEventListener('DOMContentLoaded', function() {
                const burger = document.getElementById('navbar-burger');
                const mobile = document.getElementById('navbar-mobile');
                const overlay = document.getElementById('navbar-overlay');
                const navbar = document.querySelector('.navbar');
                
                // Обработчик для бургер-меню
                if (burger && mobile && overlay) {
                    burger.addEventListener('click', function() {
                        this.classList.toggle('active');
                        mobile.classList.toggle('active');
                        overlay.classList.toggle('active');
                        document.body.classList.toggle('no-scroll');
                    });
                    
                    overlay.addEventListener('click', function() {
                        burger.classList.remove('active');
                        mobile.classList.remove('active');
                        this.classList.remove('active');
                        document.body.classList.remove('no-scroll');
                    });
                }
                
                // Эффект скролла для навбара
                if (navbar) {
                    window.addEventListener('scroll', function() {
                        if (window.scrollY > 50) {
                            navbar.classList.add('scrolled');
                        } else {
                            navbar.classList.remove('scrolled');
                        }
                    });
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>