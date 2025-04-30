<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME") }} - File Sharing</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --text-light: #f8f9fa;
            --text-muted: #6c757d;
            --bg-light: #f8f9fa;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: var(--text-light);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-icon {
            font-size: 1.8rem;
            margin-right: 0.8rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 600;
            transition: opacity var(--transition-speed);
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .nav-section {
            padding: 1rem 0;
        }

        .nav-title {
            padding: 0.5rem 1.5rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
        }

        .sidebar.collapsed .nav-title {
            opacity: 0;
            height: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            transition: background var(--transition-speed);
        }

        .nav-item a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            transition: all var(--transition-speed);
        }

        .nav-item:hover a {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active a {
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .nav-icon {
            width: 1.5rem;
            margin-right: 1rem;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar.collapsed .nav-item span:not(.nav-icon) {
            opacity: 0;
            width: 0;
            display: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 0.5rem;
            transition: margin var(--transition-speed);
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .menu-toggle {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border-radius: 5px;
            transition: background var(--transition-speed);
        }

        .menu-toggle:hover {
            background: var(--bg-light);
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
            margin: 0 1rem;
        }

        .search-box input {
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            outline: none;
            transition: all var(--transition-speed);
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu .dropdown-toggle {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            color: inherit;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            color: var(--text-muted);
        }

        /* Dashboard Content */
        .welcome-card {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .recent-files {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .file-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem 0;
        }

        .file-item:last-child {
            border-bottom: none;
        }

        .file-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 1rem;
            background: var(--bg-light);
        }

        .file-details {
            flex: 1;
        }

        .file-name {
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .file-info {
            color: var(--text-muted);
            font-size: 0.8rem;
            display: flex;
            gap: 1rem;
        }

        .file-actions {
            display: flex;
            gap: 0.5rem;
        }

        .file-action-btn {
            border: none;
            background: none;
            color: var(--text-muted);
            width: 30px;
            height: 30px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background var(--transition-speed), color var(--transition-speed);
        }

        .file-action-btn:hover {
            background: var(--bg-light);
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="overlay" id="overlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="logo-text">FileShare</div>
            </div>

            <div class="nav-section">
                <div class="nav-title">Main</div>
                <ul class="nav-items">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <span class="nav-icon"><i class="fas fa-home"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ isset($activeTab) && $activeTab == 'shared' ? 'active' : '' }}">
                        <a href="{{ route('dashboard.shared') }}">
                            <span class="nav-icon"><i class="fas fa-folder"></i></span>
                            <span>My Files</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('dashboard.shared') }}">
                            <span class="nav-icon"><i class="fas fa-share-alt"></i></span>
                            <span>Shared</span>
                        </a>
                    </li> --}}
                    <li class="nav-item {{ isset($activeTab) && $activeTab == 'all' ? 'active' : '' }}">
                        <a href="{{ route('dashboard.all') }}">
                            <span class="nav-icon "><i class="fas fa-star"></i></span>
                            <span>All Files</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-title">Settings</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-icon"><i class="fas fa-user"></i></span>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <span class="nav-icon"><i class="fas fa-cog"></i></span>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-title">User Management</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                            <span>Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <div class="top-nav">
                <button id="menuToggle" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search files...">
                </div>

                <div class="user-menu dropdown">
                    <button class="dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span>John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            // Check if we're on mobile
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                // On desktop, collapse sidebar
                sidebar.classList.toggle('collapsed');
            }
        });

        // Close sidebar when clicking overlay (mobile)
        document.getElementById('overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (window.innerWidth >= 992) {
                overlay.classList.remove('show');
                sidebar.classList.remove('show');
            }
        });
    </script>


</body>
</html>
