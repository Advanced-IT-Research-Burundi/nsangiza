<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME") }} - File Sharing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="logo-text">FileShare</div>
            </div>

            <div class="nav-section">
                <div class="nav-title">Main</div>
                <ul class="nav-items">
                    <li class="nav-item active">
                        <a href="{{ route('upload') }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('file.index') }}">
                            <span class="nav-icon text-light"><i class="fas fa-folder"></i></span>
                            My Files
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-share-alt"></i></span>
                        Shared
                    </li>
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-star"></i></span>
                        Favorites
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-title text-center">User Management</div>
                <div class="nav-title"><hr></div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-lock-open"></i></span>
                        Log Out
                    </li>
                </ul>
            </div>

        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield("content")
        </main>
    </div>
</body>
</html>
