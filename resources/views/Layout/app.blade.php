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
        :root {
            /* Unique Color Palette - "Electric Azure & Fresh Mint" */
            --primary-electric: #3B82F6;      /* bright azure blue */
            --primary-deep: #2563EB;
            --accent-mint: #10B981;
            --accent-mint-light: #D1FAE5;
            --surface-soft: #F8FAFC;
            --surface-card: #FFFFFF;
            --text-dark: #0F172A;
            --text-soft: #475569;
            --border-light: #E2E8F0;
            --glow-shadow: 0 8px 30px rgba(59, 130, 246, 0.08);
            --sidebar-glow: 0 0 0 1px rgba(59, 130, 246, 0.05);
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(145deg, #F0F5FF 0%, #F9FCFF 100%);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Abstract background shapes for depth */
        body::before {
            content: '';
            position: fixed;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -20%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            position: relative;
            z-index: 1;
        }

        /* --- MODERN SIDEBAR — GLASS MORPH + ANIMATED --- */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            color: var(--text-soft);
            min-height: 100vh;
            transition: var(--transition-smooth);
            border-right: 1px solid rgba(226, 232, 240, 0.6);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.02);
            z-index: 1000;
            position: relative;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Animated gradient edge on sidebar */
        #sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(16, 185, 129, 0.02) 100%);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        #sidebar:hover::before {
            opacity: 1;
        }

        /* Floating glow on the right edge */
        #sidebar::after {
            content: '';
            position: absolute;
            top: 10%;
            right: 0;
            width: 3px;
            height: 80%;
            background: linear-gradient(180deg, transparent, var(--primary-electric), var(--accent-mint), transparent);
            border-radius: 100px;
            opacity: 0.3;
            animation: slideGlow 4s ease-in-out infinite;
        }

        @keyframes slideGlow {
            0%, 100% { transform: translateY(0); opacity: 0.2; }
            50% { transform: translateY(10px); opacity: 0.5; }
        }

        .sidebar-brand {
            padding: 30px 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            transition: var(--transition-bounce);
            position: relative;
        }

        .sidebar-brand:hover {
            transform: scale(1.02);
            color: var(--primary-electric);
        }

        .sidebar-brand i {
            color: var(--primary-electric);
            font-size: 1.8rem;
            transition: var(--transition-bounce);
            filter: drop-shadow(0 4px 6px rgba(59, 130, 246, 0.2));
        }

        .sidebar-brand:hover i {
            transform: rotate(-10deg) scale(1.1);
            color: var(--accent-mint);
        }

        /* --- SIDEBAR NAVIGATION LINKS — UNIQUE ANIMATIONS --- */
        .nav-category {
            padding: 0 24px;
            margin-top: 24px;
            margin-bottom: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94A3B8;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        /* Decorative line that expands on hover */
        .nav-category::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 24px;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-electric), var(--accent-mint));
            transition: width 0.4s ease;
            border-radius: 10px;
        }

        .nav-category:hover::after {
            width: 40px;
        }

        #sidebar .nav-link {
            color: var(--text-soft);
            padding: 12px 20px;
            margin: 6px 16px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 14px;
            transition: var(--transition-bounce);
            display: flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: 1px solid transparent;
        }

        /* Sliding background effect */
        #sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.06), transparent);
            transition: left 0.5s ease;
            z-index: -1;
        }

        #sidebar .nav-link:hover::before {
            left: 100%;
        }

        #sidebar .nav-link i {
            margin-right: 14px;
            font-size: 1.3rem;
            transition: var(--transition-bounce);
            width: 24px;
            text-align: center;
        }

        /* Hover State — Floating + Glow */
        #sidebar .nav-link:hover {
            color: var(--primary-electric);
            background: rgba(59, 130, 246, 0.06);
            transform: translateX(6px) scale(1.02);
            border-color: rgba(59, 130, 246, 0.15);
            box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.2);
        }

        #sidebar .nav-link:hover i {
            color: var(--primary-electric);
            transform: scale(1.15) rotate(-5deg);
        }

        /* Active State — Bold + Gradient Accent */
        #sidebar .nav-link.active {
            color: white;
            background: linear-gradient(105deg, var(--primary-electric) 0%, var(--primary-deep) 100%);
            box-shadow: 0 8px 25px -5px rgba(59, 130, 246, 0.5);
            border-color: transparent;
            transform: translateX(4px) scale(1.02);
            font-weight: 700;
        }

        #sidebar .nav-link.active i {
            color: white;
            font-weight: bold;
            transform: scale(1.1);
        }

        /* Pulsing dot on active item */
        #sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background: var(--accent-mint-light);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--accent-mint);
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: translateY(-50%) scale(1); }
            50% { opacity: 0.6; transform: translateY(-50%) scale(1.4); }
        }

        /* --- CONTENT AREA --- */
        #content {
            width: 100%;
            padding: 30px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        /* Floating Glass Navbar — Modern & Clean */
        .top-navbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 16px 28px;
            box-shadow: var(--glow-shadow);
            margin-bottom: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        /* Subtle shimmer effect on navbar */
        .top-navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s ease;
        }

        .top-navbar:hover::before {
            left: 100%;
        }

        .top-navbar:hover {
            box-shadow: 0 12px 40px rgba(59, 130, 246, 0.12);
            border-color: rgba(59, 130, 246, 0.15);
        }

        .btn-menu {
            background: white;
            border: 1px solid var(--border-light);
            color: var(--text-dark);
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: var(--transition-bounce);
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn-menu i {
            font-size: 1.2rem;
            transition: var(--transition-bounce);
        }

        .btn-menu:hover {
            background: var(--primary-electric);
            border-color: var(--primary-electric);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -8px rgba(59, 130, 246, 0.5);
        }

        .btn-menu:hover i {
            transform: rotate(90deg) scale(1.1);
        }

        /* User dropdown styling */
        .dropdown-toggle {
            transition: var(--transition-bounce);
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-toggle:hover {
            background: rgba(59, 130, 246, 0.08) !important;
            transform: scale(1.02);
        }

        .dropdown-toggle i {
            color: var(--primary-electric);
            font-size: 1.3rem;
            transition: var(--transition-bounce);
        }

        .dropdown-toggle:hover i {
            transform: rotate(15deg) scale(1.1);
        }

        /* Smooth entrance animation for content */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #content > * {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Scrollbar styling */
        #sidebar::-webkit-scrollbar {
            width: 4px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 10px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--primary-electric);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #sidebar {
                min-width: 260px;
                max-width: 260px;
                margin-left: -260px;
                position: fixed;
                height: 100vh;
                z-index: 1050;
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #content {
                padding: 20px;
            }
            
            .top-navbar {
                padding: 12px 18px;
            }
        }

        /* Sidebar hidden state (toggled by JS) */
        #sidebar.d-none {
            display: none !important;
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
                        <i class="ph-fill ph-user-circle"></i> Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="ph ph-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ph ph-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="ph ph-sign-out me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Yield -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script with smooth animation -->
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            // Toggle the d-none class
            sidebar.classList.toggle('d-none');
            
            // If sidebar is hidden, expand content, else shrink
            if (sidebar.classList.contains('d-none')) {
                content.style.paddingLeft = '30px';
            } else {
                content.style.paddingLeft = '0';
            }
        });

        // Add hover effect to nav links with magnetic pull
        document.querySelectorAll('#sidebar .nav-link').forEach(link => {
            link.addEventListener('mouseenter', function(e) {
                // Subtle magnetic effect on icons
                const icon = this.querySelector('i');
                if (icon) {
                    icon.style.transition = 'all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)';
                }
            });
            
            link.addEventListener('mouseleave', function(e) {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.style.transition = 'all 0.3s ease';
                }
            });
        });

        // Add a small ripple effect on click for nav links
        document.querySelectorAll('#sidebar .nav-link, .btn-menu, .dropdown-toggle').forEach(el => {
            el.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                // Add ripple styles dynamically
                if (!document.getElementById('ripple-style')) {
                    const style = document.createElement('style');
                    style.id = 'ripple-style';
                    style.textContent = `
                        .ripple {
                            position: absolute;
                            border-radius: 50%;
                            background: rgba(59, 130, 246, 0.2);
                            transform: scale(0);
                            animation: ripple-animation 0.6s ease-out;
                            pointer-events: none;
                            z-index: 0;
                        }
                        @keyframes ripple-animation {
                            to {
                                transform: scale(4);
                                opacity: 0;
                            }
                        }
                    `;
                    document.head.appendChild(style);
                }
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>