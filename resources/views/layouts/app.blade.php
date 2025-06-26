<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- En el <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Al final del <body>, ANTES de tus scripts personalizados -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- En el head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-light: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            --shadow-dark: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        }

        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .dark-mode body {
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
        }

        .dark-mode body::before {
            background:
                radial-gradient(circle at 20% 80%, rgba(30, 30, 80, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(80, 30, 80, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(30, 80, 120, 0.3) 0%, transparent 50%);
        }

        /* Glassmorphism Navbar */
        .navbar-glass {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-light);
            border-radius: 0 0 20px 20px;
            margin-bottom: 0;
            z-index: 1030;
            /* Asegura que la navbar esté por encima */
            position: relative;
            /* Necesario para que z-index funcione */
        }

        .dropdown-menu {
            z-index: 1050 !important;
            /* Mayor que la navbar */
            position: absolute !important;
            transform: none !important;
            /* Elimina transformaciones que puedan afectar */
            will-change: transform;
            /* Optimización para animaciones */
            top: 100% !important;
            /* Posiciona justo debajo del botón */
            left: auto !important;
            right: 0 !important;
        }

        /* Si usas elementos con backdrop-filter, añade esto */
        main {
            position: relative;
            z-index: 1;
            /* Menor que el dropdown */
        }

        .dark-mode .navbar-glass {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
            z-index: 1030;
            /* Asegura que la navbar esté por encima */
            position: relative;
            /* Necesario para que z-index funcione */
        }

        .navbar-brand {
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.5rem !important;
        }

        .dark-mode .navbar-brand {
            background: var(--success-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand img {
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.1) rotate(5deg);
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            transition: left 0.3s ease;
            z-index: -1;
            border-radius: 25px;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            left: 0;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
        }

        .dark-mode .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Botón Dark Mode Mejorado */
        #darkModeToggle {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        #darkModeToggle:hover {
            transform: scale(1.1) rotate(180deg);
            background: var(--primary-gradient);
            color: white;
        }

        .dark-mode #darkModeToggle {
            background: rgba(255, 255, 255, 0.1);
            color: #f093fb;
        }

        /* Dropdown Mejorado */
        .dropdown-menu {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            padding: 0.75rem 0;
        }

        .dark-mode .dropdown-menu {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            margin: 0.25rem 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateX(5px);
        }

        /* Main Content */
        main {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            margin: 2rem;
            padding: 2rem;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--glass-border);
            min-height: calc(100vh - 200px);
        }

        .dark-mode main {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
        }

        /* Footer Glassmorphism */
        .footer-glass {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-light);
            border-radius: 20px 20px 0 0;
            margin-top: 2rem;
        }

        .dark-mode .footer-glass {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
        }

        .footer-glass .text-muted {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
        }

        .dark-mode .footer-glass .text-muted {
            background: var(--success-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animaciones */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .navbar-brand img {
            animation: float 3s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            main {
                margin: 1rem;
                padding: 1rem;
                border-radius: 15px;
            }

            .navbar-glass {
                border-radius: 0 0 15px 15px;
            }
        }

        /* Form Controls */
        .form-control:focus {
            border-color: transparent;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-danger {
            background: var(--secondary-gradient);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.6);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div id="app">
        <!-- Navigation Bar -->
        <nav id="mainNavbar" class="navbar navbar-expand-md navbar-glass">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('storage/logo.jpg') }}" alt="Logo" height="45"
                        class="me-3 d-inline-block align-text-top">
                    <span class="fw-bold">Ssamanth Clothes Shein</span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>

                <div class="collapse navbar-collapse" id="main-navbar">
                    <!-- Left -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3">
                            <button id="darkModeToggle" class="btn" title="Cambiar tema">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-2"></i> Registrarse
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="user-dropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user-cog me-2"></i> Mi Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-shrink-0">
            @include('flash::message')
            @yield('content')
        </main>

        <footer class="footer mt-auto py-4 footer-glass">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start">
                        <span class="text-muted fw-bold">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
                        </span>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted">
                            Todos los derechos reservados ✨
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Dark Mode Script -->
    <script>
        const toggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const loadingOverlay = document.getElementById('loadingOverlay');

        function showLoading() {
            loadingOverlay.classList.add('show');
        }

        function hideLoading() {
            setTimeout(() => {
                loadingOverlay.classList.remove('show');
            }, 500);
        }

        function applyTheme(isDark) {
            showLoading();

            setTimeout(() => {
                if (isDark) {
                    html.classList.add('dark-mode');
                    toggle.innerHTML = '<i class="fas fa-sun"></i>';
                    localStorage.setItem('darkMode', 'true');
                } else {
                    html.classList.remove('dark-mode');
                    toggle.innerHTML = '<i class="fas fa-moon"></i>';
                    localStorage.setItem('darkMode', 'false');
                }
                hideLoading();
            }, 300);
        }

        toggle.addEventListener('click', () => {
            const isDark = !html.classList.contains('dark-mode');
            applyTheme(isDark);
        });

        // Auto-load from localStorage
        document.addEventListener('DOMContentLoaded', () => {
            const dark = localStorage.getItem('darkMode') === 'true';
            applyTheme(dark);

            // Smooth page transitions
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Smooth navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    @stack('scripts')

    <!-- N8N Chat Integration -->
    <link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
    <style>
        /* Estilos mejorados para el chat */
        .n8n-chat {
            --n8n-chat-primary: #667eea;
            --n8n-chat-primary-hover: #5a67d8;
            --n8n-chat-bg-color: rgba(255, 255, 255, 0.95);
            --n8n-chat-border-radius: 20px;
            --n8n-chat-box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
            --n8n-chat-font-family: 'Inter', 'Poppins', sans-serif;
        }

        .n8n-chat-container {
            border-radius: var(--n8n-chat-border-radius) !important;
            box-shadow: var(--n8n-chat-box-shadow) !important;
            overflow: hidden;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .n8n-chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            padding: 1.5rem !important;
            position: relative;
            overflow: hidden;
        }

        .n8n-chat-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
            pointer-events: none;
        }

        .n8n-chat-title {
            font-weight: 700 !important;
            font-size: 1.2rem !important;
        }

        .n8n-chat-subtitle {
            opacity: 0.9 !important;
            font-weight: 400 !important;
            margin-top: 0.25rem !important;
        }

        .n8n-chat-message-bot {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%) !important;
            border-radius: 20px 20px 20px 5px !important;
            max-width: 85% !important;
            border: 1px solid rgba(102, 126, 234, 0.1);
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
        }

        .n8n-chat-message-user {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border-radius: 20px 20px 5px 20px !important;
            max-width: 85% !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .n8n-chat-input-container {
            border-top: 1px solid rgba(102, 126, 234, 0.1) !important;
            padding: 1.25rem !important;
            background: rgba(248, 249, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .n8n-chat-input {
            border-radius: 25px !important;
            padding: 1rem 1.5rem !important;
            border: 2px solid rgba(102, 126, 234, 0.2) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .n8n-chat-input:focus {
            outline: none !important;
            border-color: var(--n8n-chat-primary) !important;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.2) !important;
            transform: translateY(-1px);
        }

        .n8n-chat-send-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-radius: 50% !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .n8n-chat-send-button:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .n8n-chat-new-conversation-button {
            background: rgba(255, 255, 255, 0.9) !important;
            color: var(--n8n-chat-primary) !important;
            border: 2px solid var(--n8n-chat-primary) !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            padding: 0.75rem 1.5rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .n8n-chat-new-conversation-button:hover {
            background: var(--n8n-chat-primary) !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Dark mode para el chat */
        .dark-mode .n8n-chat-container {
            background: rgba(0, 0, 0, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dark-mode .n8n-chat-message-bot {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
            color: #e2e8f0 !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dark-mode .n8n-chat-input-container {
            background: rgba(0, 0, 0, 0.6) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .dark-mode .n8n-chat-input {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
        }

        /* Animaciones mejoradas */
        @keyframes messageSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .n8n-chat-message {
            animation: messageSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .n8n-chat-typing-indicator {
            animation: pulse 1.5s ease-in-out infinite;
        }
    </style>

    <script type="module">
        import {
            createChat
        } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

        createChat({
            webhookUrl: "{{ env('AI_ENDPOINT') }}",
            defaultLanguage: 'es',
            initialMessages: [
                '¡Hola! 👋 Bienvenido a Ssamanth Clothes',
                'Soy tu asistente virtual inteligente. ¿En qué puedo ayudarte hoy?',
                '💡 Puedo ayudarte con información sobre productos, ventas, inventario y más.'
            ],
            i18n: {
                es: {
                    title: '🤖 Asistente Virtual',
                    subtitle: 'Powered by AI • Siempre aquí para ayudarte',
                    footer: 'Respuestas generadas por IA avanzada',
                    getStarted: '✨ Nueva conversación',
                    inputPlaceholder: 'Escribe tu pregunta aquí...',
                },
            },
            theme: {
                primaryColor: '#667eea',
                secondaryColor: '#f8f9ff',
                textColorOnPrimary: '#ffffff',
                textColor: '#2d3748',
            },
            settings: {
                avatarUrl: 'https://cdn-icons-png.flaticon.com/512/4712/4712035.png',
                botName: 'Asistente IA',
                userAvatarUrl: 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                showWelcomeScreen: true,
                showPoweredBy: false,
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
