<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen Perpustakaan - Kelola koleksi buku dengan mudah">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --gradient-1: linear-gradient(135deg, #6366f1, #8b5cf6, #a855f7);
            --gradient-2: linear-gradient(135deg, #0ea5e9, #6366f1);
            --shadow-glow: 0 0 20px rgba(99, 102, 241, 0.3);
            --radius: 12px;
            --radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ═══ ANIMATED BACKGROUND ═══ */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .bg-pattern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(14, 165, 233, 0.06) 0%, transparent 50%),
                        radial-gradient(circle at 50% 20%, rgba(168, 85, 247, 0.05) 0%, transparent 50%);
            animation: bgFloat 20s ease-in-out infinite;
        }
        @keyframes bgFloat {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(2%, 1%) rotate(1deg); }
            66% { transform: translate(-1%, 2%) rotate(-1deg); }
        }

        /* ═══ NAVBAR ═══ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.15);
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.25rem;
        }
        .navbar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary-light);
        }
        .nav-link.active {
            background: rgba(99, 102, 241, 0.2);
        }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--gradient-2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
        }
        .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
        }
        .btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            font-family: inherit;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* ═══ MAIN CONTENT ═══ */
        .main-content {
            position: relative;
            z-index: 1;
            padding: 90px 2rem 2rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* ═══ PAGE HEADER ═══ */
        .page-header {
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
        }
        .page-header p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* ═══ CARDS ═══ */
        .card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            transition: var(--transition);
        }
        .card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: var(--shadow-glow);
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        /* ═══ STAT CARDS ═══ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--dark-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }
        .stat-card.purple::before { background: var(--gradient-1); }
        .stat-card.blue::before { background: linear-gradient(135deg, #0ea5e9, #38bdf8); }
        .stat-card.green::before { background: linear-gradient(135deg, #10b981, #34d399); }
        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: var(--shadow-glow);
        }
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .stat-icon.purple { background: rgba(99, 102, 241, 0.15); color: #818cf8; }
        .stat-icon.blue { background: rgba(14, 165, 233, 0.15); color: #38bdf8; }
        .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .stat-info h3 {
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-info p {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* ═══ BUTTONS ═══ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
            line-height: 1.4;
        }
        .btn-primary {
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.45);
        }
        .btn-secondary {
            background: rgba(51, 65, 85, 0.6);
            color: var(--text-primary);
            border: 1px solid var(--dark-border);
        }
        .btn-secondary:hover {
            background: rgba(51, 65, 85, 0.9);
            border-color: var(--primary);
        }
        .btn-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.25);
        }
        .btn-warning:hover {
            background: rgba(245, 158, 11, 0.25);
        }
        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }
        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
        }
        .btn-info {
            background: rgba(14, 165, 233, 0.15);
            color: #38bdf8;
            border: 1px solid rgba(14, 165, 233, 0.25);
        }
        .btn-info:hover {
            background: rgba(14, 165, 233, 0.25);
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        /* ═══ TABLE ═══ */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius-lg);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: rgba(99, 102, 241, 0.1);
            padding: 14px 16px;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--dark-border);
        }
        tbody td {
            padding: 14px 16px;
            font-size: 0.9rem;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(51, 65, 85, 0.4);
        }
        tbody tr {
            transition: var(--transition);
        }
        tbody tr:hover {
            background: rgba(99, 102, 241, 0.05);
        }
        .actions-cell {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        /* ═══ FORMS ═══ */
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            transition: var(--transition);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .form-control::placeholder {
            color: var(--text-muted);
        }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2394a3b8'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            padding-right: 40px;
        }
        .form-error {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 4px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        /* ═══ ALERTS ═══ */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
        }
        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        /* ═══ BADGE ═══ */
        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        .badge-primary {
            background: rgba(99, 102, 241, 0.2);
            color: #a5b4fc;
        }
        .badge-success {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }
        .badge-warning {
            background: rgba(245, 158, 11, 0.2);
            color: #fcd34d;
        }
        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        /* ═══ PAGINATION ═══ */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }
        .pagination-wrapper nav > div:first-child { display: none; }
        .pagination-wrapper nav > div { display: flex; align-items: center; gap: 4px; }
        .pagination-wrapper a, .pagination-wrapper span {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }
        .pagination-wrapper a {
            background: rgba(51, 65, 85, 0.5);
            color: var(--text-secondary);
            border: 1px solid var(--dark-border);
        }
        .pagination-wrapper a:hover {
            background: rgba(99, 102, 241, 0.2);
            color: var(--primary-light);
            border-color: var(--primary);
        }
        .pagination-wrapper span[aria-current] {
            background: var(--primary);
            color: white;
        }
        .pagination-wrapper span[aria-disabled] {
            background: rgba(51, 65, 85, 0.3);
            color: var(--text-muted);
        }

        /* ═══ SEARCH BAR ═══ */
        .toolbar {
            display: flex;
            gap: 12px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .search-box input {
            padding-left: 42px;
        }
        .filter-select {
            min-width: 180px;
        }

        /* ═══ DETAIL PAGE ═══ */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .detail-item {
            padding: 1rem;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 10px;
            border: 1px solid rgba(51, 65, 85, 0.5);
        }
        .detail-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-weight: 600;
        }
        .detail-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-primary);
        }
        @media (max-width: 640px) {
            .detail-grid { grid-template-columns: 1fr; }
            .main-content { padding: 80px 1rem 1rem; }
        }

        /* ═══ EMPTY STATE ═══ */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state i {
            font-size: 3rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }
        .empty-state h3 {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }
        .empty-state p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* ═══ ANIMATION ═══ */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stagger-1 { animation-delay: 0.05s; }
        .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="brand-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <span>Perpustakaan</span>
        </a>

        <ul class="navbar-nav">
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <i class="fas fa-book"></i> Daftar Buku
                </a>
            </li>
        </ul>

        <div class="navbar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <span class="user-name">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
