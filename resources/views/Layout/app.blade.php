<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Battery System') }} - Dashboard</title>

    <!-- Google Fonts: Plus Jakarta Sans (Modern SaaS Font) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Phosphor Icons (Modern, clean icons) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f7f6; /* Very soft off-white background */
            color: #1e293b;
            overflow-x: hidden;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        
        /* --- MODERN WHITE SIDEBAR --- */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: #ffffff; /* Crisp White */
            color: #64748b;
            min-height: 100vh;
            transition: all 0.3s;
            border-right: 1px solid #e2e8f0; /* Subtle border */
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 30px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e293b;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }
        .sidebar-brand i {
            color: #4f46e5; /* Indigo */
            font-size: 1.8rem;
        }

        /* --- SIDEBAR NAVIGATION LINKS --- */
        .nav-category {
            padding: 0 24px;
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }

        #sidebar .nav-link {
            color: #64748b;
            padding: 12px 20px;
            margin: 4px 16px; /* Floating pill effect */
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 12px; /* Rounded pill */
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        #sidebar .nav-link i {
            margin-right: 14px;
            font-size: 1.3rem;
            transition: all 0.2s ease-in-out;
        }

        /* Hover State */
        #sidebar .nav-link:hover {
            color: #1e293b;
            background: #f8fafc; /* Soft gray */
        }
        #sidebar .nav-link:hover i {
            color: #4f46e5; /* Icon turns indigo on hover */
        }

        /* Active State */
        #sidebar .nav-link.active {
            color: #4f46e5; /* Indigo text */
            background: #eef2ff; /* Soft Indigo background */
        }
        #sidebar .nav-link.active i {
            color: #4f46e5;
            font-weight: bold;
        }

        /* --- CONTENT AREA --- */
        #content {
            width: 100%;
            padding: 30px;
            min-height: 100vh;
        }
        
        /* Floating Glass Navbar */
        .top-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 15px 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn-menu {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-menu:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="ph-fill ph-battery-charging"></i>
                PakBattery
            </a>
            
            <!-- Include the sidebar file here -->
            @include('Layout.sidebar')
            
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <button type="button" id="sidebarCollapse" class="btn btn-menu">
                    <i class="ph ph-list"></i> Menu
                </button>
                
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle border-0 fw-bold" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent;">
                        <i class="ph-fill ph-user-circle text-primary" style="font-size: 1.2rem;"></i> Admin
                    </button>
                </div>
            </div>

            <!-- Main Content Yield -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('d-none');
        });
    </script>
    
    @stack('scripts')
</body>
</html>