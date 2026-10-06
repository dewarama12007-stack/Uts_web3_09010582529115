<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'KireiLibrary') - Perpustakaan</title>
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>

    <!-- Tailwind CSS with Stitch Theme Configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#0b1c30",
                        "on-primary-fixed-variant": "#3b35a7",
                        "tertiary-fixed-dim": "#6bd8cb",
                        "tertiary-fixed": "#89f5e7",
                        "surface-container": "#e5eeff",
                        "background": "#f8f9ff",
                        "on-surface-variant": "#464553",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed": "#0f0069",
                        "on-error": "#ffffff",
                        "surface-tint": "#544fc0",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-container-high": "#dce9ff",
                        "on-secondary-container": "#57657a",
                        "primary-fixed-dim": "#c3c0ff",
                        "on-primary-container": "#a9a7ff",
                        "inverse-surface": "#213145",
                        "error": "#ba1a1a",
                        "surface-container-low": "#eff4ff",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e",
                        "inverse-primary": "#c3c0ff",
                        "tertiary": "#00332e",
                        "surface-variant": "#d3e4fe",
                        "secondary-container": "#d5e3fc",
                        "secondary-fixed": "#d5e3fc",
                        "primary-fixed": "#e2dfff",
                        "surface": "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        "on-tertiary-fixed": "#00201d",
                        "primary": "#1f108e",
                        "on-primary": "#ffffff",
                        "on-background": "#0b1c30",
                        "on-tertiary-fixed-variant": "#005049",
                        "on-error-container": "#93000a",
                        "primary-container": "#3730a3",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#52c1b4",
                        "surface-dim": "#cbdbf5",
                        "surface-container-highest": "#d3e4fe",
                        "on-secondary-fixed-variant": "#3a485b",
                        "outline-variant": "#c8c4d5",
                        "outline": "#777584",
                        "surface-bright": "#f8f9ff",
                        "tertiary-container": "#004c45",
                        "secondary": "#515f74"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "space-md": "1rem",
                        "space-lg": "1.5rem",
                        "space-xl": "2rem",
                        "margin": "2rem"
                    },
                    fontFamily: {
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "headline-xl": ["Inter"],
                        "code-sm": ["monospace"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-body-md text-on-surface antialiased min-h-screen">
    <!-- Mobile Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Navigation Sidebar -->
    <aside id="app-sidebar" class="fixed left-0 top-0 h-screen w-[260px] bg-surface-container-lowest border-r border-outline-variant/40 z-50 flex flex-col justify-between -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col">
            <!-- Brand / Logo -->
            <div class="h-16 px-space-lg flex items-center justify-between border-b border-outline-variant/30">
                <div class="flex items-center gap-space-sm">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo KireiLibrary" class="w-9 h-9 rounded-lg shadow-sm object-contain">
                    <div class="flex flex-col">
                        <span class="font-headline-md text-headline-md font-bold text-on-surface tracking-tight leading-none">KireiLibrary</span>
                        <span class="text-[10px] text-secondary font-medium tracking-wide">Sistem Perpustakaan</span>
                    </div>
                </div>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1 text-secondary hover:text-on-surface rounded-md">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-space-md flex flex-col gap-space-xs">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-surface-container-low text-primary-container font-semibold shadow-xs' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('books.index') }}" 
                   class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ (request()->routeIs('books.index') || request()->routeIs('books.show') || request()->routeIs('books.edit')) ? 'bg-surface-container-low text-primary-container font-semibold shadow-xs' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">menu_book</span>
                    <span>Daftar Buku</span>
                </a>

                <a href="{{ route('books.create') }}" 
                   class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('books.create') ? 'bg-surface-container-low text-primary-container font-semibold shadow-xs' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                    <span>Tambah Buku</span>
                </a>

                <div class="my-2 pt-2 border-t border-outline-variant/30">
                    <span class="px-space-md text-[10px] font-semibold text-secondary uppercase tracking-wider block mb-1">Fitur Ekstra</span>
                    <a href="{{ route('books.export') }}" 
                       class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors font-medium text-xs">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        <span>Unduh Katalog (CSV)</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-space-md border-t border-outline-variant/30 flex flex-col gap-1">
            <div class="px-space-md py-0.5 flex items-center justify-between text-secondary font-label-sm text-xs">
                <span class="font-medium text-on-surface">KireiLibrary v1.0</span>
                <span class="inline-flex items-center gap-1 text-[11px] text-emerald-600 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Aktif
                </span>
            </div>
            <div class="px-space-md text-[11px] text-secondary font-mono">
                Dewa Rama danieal
            </div>
        </div>
    </aside>

    <!-- Main Workspace Container -->
    <div class="lg:pl-[260px] min-h-screen flex flex-col transition-all">
        <!-- Top App Bar -->
        <header class="fixed top-0 left-0 lg:left-[260px] right-0 h-16 bg-surface-container-lowest border-b border-outline-variant/30 z-30 px-4 sm:px-space-xl flex items-center justify-between shadow-[0_1px_8px_rgba(0,0,0,0.02)]">
            <div class="flex items-center gap-space-xs font-label-md text-label-md text-on-surface-variant">
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-on-surface-variant hover:text-on-surface rounded-lg mr-1 focus:outline-none" aria-label="Buka menu">
                    <span class="material-symbols-outlined text-[24px]">menu</span>
                </button>
                <span class="hidden sm:inline hover:text-on-surface transition-colors">KireiLibrary</span>
                <span class="hidden sm:inline text-outline">/</span>
                <span class="text-on-surface font-semibold capitalize text-sm sm:text-base">@yield('title', 'Portal')</span>
            </div>

            <!-- User Menu & Logout -->
            <div class="flex items-center gap-space-md">
                <div class="flex items-center gap-space-sm sm:gap-space-md">
                    <div class="flex flex-col text-right hidden sm:flex">
                        <span class="font-label-md text-label-md font-semibold text-on-surface leading-tight">{{ Auth::user()->name }}</span>
                        <span class="font-label-sm text-[11px] text-secondary">Pengelola Perpustakaan</span>
                    </div>
                    
                    <div class="w-9 h-9 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary-container text-sm ring-2 ring-primary-fixed">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-error bg-error-container/20 hover:bg-error-container/40 transition-colors cursor-pointer"
                                title="Keluar dari akun">
                            <span class="material-symbols-outlined text-[16px]">logout</span>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="w-full pt-16 p-4 sm:p-6 lg:p-8 bg-background flex-1">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 text-sm shadow-xs transition-opacity duration-300" id="flash-success">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">check_circle</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="document.getElementById('flash-success').remove()" class="text-emerald-500 hover:text-emerald-800">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 flex items-center justify-between text-red-800 text-sm shadow-xs transition-opacity duration-300" id="flash-error">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-600 text-[20px]">error</span>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="document.getElementById('flash-error').remove()" class="text-red-500 hover:text-red-800">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Sidebar & Alert Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        // Auto fade out flash messages after 4 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('flash-success');
            if (successAlert) {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 400);
            }
        }, 4000);
    </script>
</body>
</html>
