<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileShare - My Files</title>
    <style>
        :root {
            --primary: #1a56db;
            --primary-light: #3b82f6;
            --secondary: #0ea5e9;
            --accent: #0369a1;
            --text-main: #1e293b;
            --text-light: #64748b;
            --bg-light: #f1f5f9;
            --bg-dark: #0f172a;
            --bg-card: #FFFFFF;
            --border-color: #cbd5e1;
            --success: #22c55e;
            --warning: #f59e0b;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            line-height: 1.6;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: var(--bg-dark);
            border-right: 1px solid var(--border-color);
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            color: #e2e8f0;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 24px 24px;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-icon {
            color: var(--primary-light);
            font-size: 24px;
            margin-right: 12px;
        }

        .logo-text {
            font-weight: 700;
            font-size: 18px;
            color: white;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-title {
            padding: 8px 24px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 600;
        }

        .nav-items {
            list-style-type: none;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #e2e8f0;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .nav-item:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }

        .nav-item.active {
            background-color: rgba(59, 130, 246, 0.3);
            color: white;
            font-weight: 600;
            position: relative;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: var(--primary-light);
        }

        .nav-icon {
            margin-right: 12px;
            font-size: 18px;
        }

        .storage-section {
            margin-top: auto;
            padding: 16px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .storage-title {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .storage-bar {
            height: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .storage-fill {
            height: 100%;
            width: 65%;
            background-color: var(--primary-light);
            border-radius: 4px;
        }

        .storage-text {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
        }

        .search-bar {
            position: relative;
            width: 320px;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            border: none;
        }

        .btn-icon {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .btn-outline:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .user-menu:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
        }

        .user-info {
            line-height: 1.2;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-email {
            font-size: 12px;
            color: var(--text-light);
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
        }

        .breadcrumb-item.active {
            color: var(--text-main);
            font-weight: 600;
        }

        .breadcrumb-separator {
            margin: 0 8px;
            color: var(--text-light);
        }

        /* Folder Structure */
        .folder-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .folder-card {
            background-color: var(--bg-card);
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }

        .folder-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .folder-icon {
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .folder-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .folder-info {
            margin-top: auto;
            font-size: 12px;
            color: var(--text-light);
            display: flex;
            justify-content: space-between;
        }

        /* File Table */
        .file-table-container {
            background-color: var(--bg-card);
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 32px;
        }

        .file-table {
            width: 100%;
            border-collapse: collapse;
        }

        .file-table th,
        .file-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .file-table th {
            font-weight: 600;
            color: var(--text-light);
            font-size: 14px;
            background-color: #f8fafc;
        }

        .file-table tr:last-child td {
            border-bottom: none;
        }

        .file-table tr:hover {
            background-color: #f1f5f9;
        }

        .file-row {
            transition: background-color 0.2s;
        }

        .file-cell-name {
            display: flex;
            align-items: center;
        }

        .file-type-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .file-type-icon.pdf {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .file-type-icon.doc {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .file-type-icon.sheet {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .file-type-icon.image {
            background-color: rgba(14, 165, 233, 0.1);
            color: var(--secondary);
        }

        .file-type-icon.video {
            background-color: rgba(168, 85, 247, 0.1);
            color: #a855f7;
        }

        .file-name-text {
            font-weight: 500;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
        }

        .file-action {
            color: var(--text-light);
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .file-action:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--text-main);
        }

        .file-tags {
            display: flex;
            gap: 8px;
        }

        .file-tag {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .file-tag.personal {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .file-tag.work {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .file-tag.important {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .file-size {
            white-space: nowrap;
        }

        .file-date {
            white-space: nowrap;
        }

        .file-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .filter-group {
            display: flex;
            gap: 12px;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: white;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            border-color: var(--primary-light);
        }

        .filter-icon {
            color: var(--text-light);
        }

        .sort-text {
            color: var(--text-light);
            font-size: 14px;
            margin-right: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                padding: 16px 0;
            }

            .nav-section {
                display: none;
            }

            .storage-section {
                display: none;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .search-bar {
                width: 100%;
            }

            .folder-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .action-buttons {
                width: 100%;
                justify-content: space-between;
            }

            .file-table th:nth-child(3),
            .file-table td:nth-child(3),
            .file-table th:nth-child(4),
            .file-table td:nth-child(4) {
                display: none;
            }

            .file-actions {
                flex-direction: column;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .main-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        .folder-card, .file-table-container {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        Dashboard
                    </li>
                    <li class="nav-item active">
                        <span class="nav-icon"><i class="fas fa-folder"></i></span>
                        My Files
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
                <div class="nav-title">Spaces</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        Marketing Team
                    </li>
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        Product Design
                    </li>
                    <li class="nav-item">
                        <span class="nav-icon"><i class="fas fa-plus"></i></span>
                        Create Space
                    </li>
                </ul>
            </div>

            <div class="storage-section">
                <div class="storage-title">
                    <span>Storage</span>
                    <span>65%</span>
                </div>
                <div class="storage-bar">
                    <div class="storage-fill"></div>
                </div>
                <div class="storage-text">6.5 GB of 10 GB used</div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1 class="page-title">My Files</h1>

                <div class="search-bar">
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                    <input type="text" class="search-input" placeholder="Search files and folders...">
                </div>

                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <span class="btn-icon"><i class="fas fa-folder-plus"></i></span>
                        New Folder
                    </button>
                    <button class="btn btn-primary">
                        <span class="btn-icon"><i class="fas fa-upload"></i></span>
                        Upload Files
                    </button>
                </div>

                <div class="user-menu">
                    <div class="user-avatar">JS</div>
                    <div class="user-info">
                        <div class="user-name">John Smith</div>
                        <div class="user-email">john@example.com</div>
                    </div>
                </div>
            </div>

            <div class="breadcrumb">
                <div class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                </div>
                <div class="breadcrumb-separator">
                    <i class="fas fa-chevron-right"></i>
                </div>
                <div class="breadcrumb-item active">My Files</div>
            </div>

            <div class="filter-section">
                <div class="filter-group">
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <span class="filter-icon"><i class="fas fa-filter"></i></span>
                            Filter
                        </button>
                    </div>
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <span class="filter-icon"><i class="fas fa-tag"></i></span>
                            Tags
                        </button>
                    </div>
                </div>
                <div class="filter-group">
                    <span class="sort-text">Sort by:</span>
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            Date Modified
                            <span class="filter-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                    </div>
                </div>
            </div>

            <h2 class="section-title" style="margin-bottom: 16px;">Recent Files</h2>
            <div class="file-table-container">
                <table class="file-table">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Name</th>
                            <th style="width: 15%;">Tags</th>
                            <th style="width: 15%;">Size</th>
                            <th style="width: 15%;">Modified</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="file-row">
                            <td>
                                <div class="file-cell-name">
                                    <div class="file-type-icon pdf">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <span class="file-name-text">Project_Proposal_Final_v2.pdf</span>
                                </div>
                            </td>
                            <td>
                                <div class="file-tags">
                                    <span class="file-tag work">Work</span>
                                    <span class="file-tag important">Important</span>
                                </div>
                            </td>
                            <td class="file-size">2.4 MB</td>
                            <td class="file-date">Apr 9, 2025</td>
                            <td>
                                <div class="file-actions">
                                    <div class="file-action">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="file-row">
                            <td>
                                <div class="file-cell-name">
                                    <div class="file-type-icon image">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                    <span class="file-name-text">Team_Photo_2025.jpg</span>
                                </div>
                            </td>
                            <td>
                                <div class="file-tags">
                                    <span class="file-tag personal">Personal</span>
                                </div>
                            </td>
                            <td class="file-size">3.8 MB</td>
                            <td class="file-date">Apr 7, 2025</td>
                            <td>
                                <div class="file-actions">
                                    <div class="file-action">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="file-row">
                            <td>
                                <div class="file-cell-name">
                                    <div class="file-type-icon doc">
                                        <i class="fas fa-file-word"></i>
                                    </div>
                                    <span class="file-name-text">Meeting_Notes_Q1_Review.docx</span>
                                </div>
                            </td>
                            <td>
                                <div class="file-tags">
                                    <span class="file-tag work">Work</span>
                                </div>
                            </td>
                            <td class="file-size">512 KB</td>
                            <td class="file-date">Apr 5, 2025</td>
                            <td>
                                <div class="file-actions">
                                    <div class="file-action">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="file-row">
                            <td>
                                <div class="file-cell-name">
                                    <div class="file-type-icon sheet">
                                        <i class="fas fa-file-excel"></i>
                                    </div>
                                    <span class="file-name-text">Budget_Forecast_2025_Q2.xlsx</span>
                                </div>
                            </td>
                            <td>
                                <div class="file-tags">
                                    <span class="file-tag work">Work</span>
                                    <span class="file-tag important">Important</span>
                                </div>
                            </td>
                            <td class="file-size">1.2 MB</td>
                            <td class="file-date">Apr 3, 2025</td>
                            <td>
                                <div class="file-actions">
                                    <div class="file-action">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="file-row">
                            <td>
                                <div class="file-cell-name">
                                    <div class="file-type-icon video">
                                        <i class="fas fa-file-video"></i>
                                    </div>
                                    <span class="file-name-text">Product_Demo_v2.1.mp4</span>
                                </div>
                            </td>
                            <td>
                                <div class="file-tags">
                                    <span class="file-tag work">Work</span>
                                </div>
                            </td>
                            <td class="file-size">24.5 MB</td>
                            <td class="file-date">Apr 1, 2025</td>
                            <td>
                                <div class="file-actions">
                                    <div class="file-action">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <div class="file-action">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
