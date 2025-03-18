<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-bg: #f8f9fa;
            --sidebar-width: 250px;
        }

        [data-bs-theme="dark"] {
            --primary-bg: #212529;
            color-scheme: dark;
        }

        body {
            background-color: var(--primary-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        [data-bs-theme="dark"] .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.3);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        [data-bs-theme="dark"] .card {
            box-shadow: 0 2px 10px rgba(0,0,0,.3);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,.2);
        }

        [data-bs-theme="dark"] .card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,.4);
        }

        .theme-switch {
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .theme-switch:hover {
            background-color: rgba(0,0,0,.1);
        }

        [data-bs-theme="dark"] .theme-switch:hover {
            background-color: rgba(255,255,255,.1);
        }

        .btn {
            border-radius: 5px;
            padding: 8px 20px;
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .nav-link {
            padding: 0.8rem 1rem;
            color: #333;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }

        .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
            font-weight: 500;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
        }

        .page-header {
            margin-bottom: 2rem;
            padding: 1rem 0;
            border-bottom: 1px solid #dee2e6;
        }

        .stats-card {
            padding: 1.5rem;
        }

        .stats-card .icon {
            font-size: 2rem;
            opacity: 0.7;
        }

        .form-control, .form-select {
            border-radius: 5px;
            padding: 0.6rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.15);
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <main class="py-4">
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Theme Switch Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', theme);
            updateThemeIcon(theme);
        });

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        }

        function updateThemeIcon(theme) {
            const icon = document.getElementById('themeIcon');
            if (icon) {
                icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }
        }
    </script>

    @stack('scripts')
</body>
</html> 