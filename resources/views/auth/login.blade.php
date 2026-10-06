<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - KireiLibrary Perpustakaan</title>
    
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
    <main class="w-full min-h-screen bg-background flex flex-col justify-center items-center">
        <div class="flex flex-col w-full">
            <div class="w-full flex flex-col lg:flex-row min-h-screen">
                <!-- Left Hero & Branding Showcase Panel -->
                <div class="w-full lg:w-1/2 bg-gradient-to-br from-primary-container via-primary to-inverse-surface relative overflow-hidden flex flex-col justify-between p-8 sm:p-12 lg:p-16 text-on-primary">
                    <!-- Architectural Atmospheric Gradients -->
                    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-primary-fixed-dim/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 right-0 w-[30rem] h-[30rem] rounded-full bg-tertiary-fixed-dim/10 blur-3xl pointer-events-none"></div>

                    <!-- Top Header Brand Element -->
                    <div class="relative z-10 flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-surface-container-lowest p-2 shadow-xl flex items-center justify-center text-primary-container">
                            <span class="material-symbols-outlined text-[28px]">menu_book</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-headline-lg text-2xl font-bold tracking-tight text-white leading-none">KireiLibrary</span>
                            <span class="font-label-sm text-xs text-primary-fixed-dim/80 uppercase tracking-widest mt-1">Perpustakaan yang Indah</span>
                        </div>
                    </div>

                    <!-- Central Library Aesthetic Composition -->
                    <div class="relative z-10 my-10 lg:my-auto flex flex-col items-start max-w-lg">
                        <!-- Archival Visual Motif -->
                        <div class="w-full mb-8 relative p-6 rounded-2xl bg-white/5 backdrop-blur-md shadow-2xl overflow-hidden border border-white/10">
                            <div class="flex justify-between items-center mb-5 pb-3 border-b border-white/10">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-tertiary-fixed animate-ping"></span>
                                    <span class="font-code-sm text-xs text-surface-container-low/90 tracking-wide uppercase">Rak Utama • Zona 04</span>
                                </div>
                                <span class="font-label-sm text-xs bg-white/10 px-2.5 py-0.5 rounded-full text-white/90">Inventaris Terkini</span>
                            </div>

                            <!-- Stylized Modern Bookshelf Graphic -->
                            <div class="relative h-44 w-full flex items-end justify-between px-2 pt-4">
                                <!-- Book Spine Series -->
                                <div class="flex items-end gap-1.5 h-full z-10">
                                    <div class="w-4 h-32 rounded-t-sm bg-tertiary-fixed-dim/90 shadow-sm"></div>
                                    <div class="w-6 h-40 rounded-t-sm bg-surface-container-lowest shadow-sm flex flex-col justify-center items-center py-2">
                                        <span class="font-code-sm text-[8px] text-primary [writing-mode:vertical-rl] tracking-tighter opacity-80 uppercase font-semibold">SAINS-102</span>
                                    </div>
                                    <div class="w-5 h-28 rounded-t-sm bg-secondary-fixed shadow-sm"></div>
                                    <div class="w-7 h-36 rounded-t-sm bg-primary-fixed-dim shadow-sm flex flex-col justify-end items-center pb-2">
                                        <span class="w-3 h-0.5 bg-primary/40 rounded-full mb-1"></span>
                                        <span class="w-3 h-0.5 bg-primary/40 rounded-full"></span>
                                    </div>
                                    <div class="w-5 h-24 rounded-t-sm bg-tertiary-fixed/80"></div>
                                </div>

                                <!-- Stylized Study Reading Desk with Lamp -->
                                <div class="flex items-end z-10 gap-3">
                                    <div class="flex flex-col items-center relative">
                                        <div class="w-8 h-4 rounded-t-full bg-tertiary-fixed shadow-[0_0_24px_rgba(137,245,231,0.85)]"></div>
                                        <div class="w-1 h-14 bg-surface-container-lowest/80"></div>
                                        <div class="w-5 h-1.5 bg-surface-container-lowest/90 rounded-sm"></div>
                                    </div>
                                    <div class="flex flex-col items-center gap-0.5 pb-0.5">
                                        <div class="w-10 h-2 bg-primary-fixed rounded-sm shadow-xs"></div>
                                        <div class="w-12 h-2.5 bg-surface-container-lowest rounded-sm shadow-xs"></div>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 h-2 bg-surface-container-lowest/30 rounded-full backdrop-blur-sm"></div>
                            </div>

                            <!-- Bottom Metadata -->
                            <div class="mt-4 pt-3 flex items-center justify-between text-white/70 font-label-sm text-xs border-t border-white/10">
                                <span class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[15px] text-tertiary-fixed">auto_stories</span>
                                    Koleksi Terintegrasi
                                </span>
                                <span class="flex items-center gap-1.5 font-code-sm text-xs">
                                    <span class="material-symbols-outlined text-[15px] text-primary-fixed">verified</span>
                                    Laravel 11 • MVC
                                </span>
                            </div>
                        </div>

                        <!-- Tagline -->
                        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight mb-3">
                            Kelola koleksi buku dengan mudah
                        </h1>
                        <p class="text-primary-fixed/90 leading-relaxed font-normal text-sm sm:text-base">
                            Pusat pengelolaan repositori literatur, sirkulasi inventaris, dan katalogisasi arsip terintegrasi untuk pustakawan modern.
                        </p>
                    </div>

                    <!-- Left Panel Institutional Meta Footer -->
                    <div class="relative z-10 pt-6 flex flex-wrap items-center justify-between gap-4 text-xs text-surface-container-low/75 border-t border-white/10">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Server Repositori Aktif (UTS Pemrograman Web)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span>Dewa Rama Daniel</span>
                            <span>•</span>
                            <span>09010582529115</span>
                        </div>
                    </div>
                </div>

                <!-- Right Half: Administrative Access Card -->
                <div class="w-full lg:w-1/2 bg-background flex flex-col items-center justify-center p-6 sm:p-12 lg:p-16">
                    <div class="w-full max-w-[440px] flex flex-col">
                        <!-- White Elevated Card -->
                        <div class="bg-surface-container-lowest rounded-2xl shadow-lg border border-slate-200/80 p-8 sm:p-10 flex flex-col transition-all">
                            <!-- Header -->
                            <div class="mb-6">
                                <div class="inline-flex items-center gap-1.5 text-primary-container text-xs uppercase tracking-wider font-semibold mb-2">
                                    <span class="material-symbols-outlined text-[16px]">lock_person</span>
                                    Autentikasi Pengelola
                                </div>
                                <h2 class="text-2xl font-bold text-slate-900 tracking-tight leading-snug">Masuk ke KireiLibrary</h2>
                                <p class="text-slate-500 text-sm mt-1.5">
                                    Silakan masukkan kredensial akun pustakawan Anda.
                                </p>
                            </div>

                            <!-- Error Alert Box -->
                            @if ($errors->any())
                                <div class="bg-red-50 border border-red-200 rounded-xl p-3.5 flex items-center gap-2.5 text-sm text-red-700 font-medium mb-6 animate-pulse" id="error-alert">
                                    <span class="material-symbols-outlined text-red-600 text-[20px] flex-shrink-0">error</span>
                                    <span class="flex-1">{{ $errors->first() }}</span>
                                    <button class="text-red-400 hover:text-red-700 focus:outline-none" onclick="document.getElementById('error-alert').remove()" type="button">
                                        <span class="material-symbols-outlined text-[18px]">close</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="{{ url('/login') }}" class="flex flex-col gap-4">
                                @csrf

                                <!-- Email -->
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-xs font-semibold text-slate-700 tracking-wide" for="librarian-email">
                                        Email
                                    </label>
                                    <div class="relative flex items-center">
                                        <input 
                                            class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition" 
                                            id="librarian-email" 
                                            name="email" 
                                            placeholder="admin@perpustakaan.com" 
                                            required 
                                            type="email" 
                                            value="{{ old('email', 'admin@perpustakaan.com') }}"
                                            autofocus
                                        >
                                        <div class="absolute right-3 pointer-events-none text-slate-400 flex items-center">
                                            <span class="material-symbols-outlined text-[18px]">mail</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password with Interactive Toggle -->
                                <div class="flex flex-col gap-1.5">
                                    <div class="flex justify-between items-center">
                                        <label class="text-xs font-semibold text-slate-700 tracking-wide" for="librarian-password">
                                            Password
                                        </label>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input 
                                            class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition pr-10" 
                                            id="librarian-password" 
                                            name="password" 
                                            placeholder="Masukkan kata sandi" 
                                            required 
                                            type="password"
                                            value="password"
                                        >
                                        <button 
                                            aria-label="Lihat atau sembunyikan kata sandi" 
                                            class="absolute right-2.5 p-1 text-slate-400 hover:text-slate-700 focus:outline-none rounded flex items-center justify-center transition" 
                                            id="toggle-password-btn" 
                                            onclick="togglePasswordVisibility()" 
                                            type="button"
                                        >
                                            <span class="material-symbols-outlined text-[20px]" id="eye-icon">visibility</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember me -->
                                <div class="flex items-center justify-between pt-1">
                                    <label class="flex items-center gap-2 cursor-pointer select-none">
                                        <input 
                                            checked 
                                            class="w-4 h-4 rounded border-slate-300 text-indigo-700 accent-indigo-700 focus:ring-indigo-600 cursor-pointer" 
                                            id="remember-me" 
                                            name="remember" 
                                            type="checkbox"
                                        >
                                        <span class="text-xs text-slate-600 font-medium hover:text-slate-800 transition">Ingat saya</span>
                                    </label>
                                    <span class="text-xs text-slate-400">Akses Terlindungi</span>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    class="w-full mt-2 bg-[#3730A3] hover:bg-indigo-800 text-white font-semibold py-2.5 rounded-lg shadow-sm transition flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer" 
                                    type="submit"
                                >
                                    <span>Masuk</span>
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </button>
                            </form>

                            <!-- Demo Credentials Helper -->
                            <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col gap-1 text-xs text-slate-500 bg-slate-50 p-3 rounded-lg border border-slate-200/60">
                                <div class="font-semibold text-slate-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-indigo-600">badge</span>
                                    Akun Demo Penguji / Dosen:
                                </div>
                                <div class="flex justify-between text-slate-600 font-mono text-[11px] mt-0.5">
                                    <span>Email: <strong>admin@perpustakaan.com</strong></span>
                                    <span>Pass: <strong>password</strong></span>
                                </div>
                            </div>

                            <!-- Security Badge -->
                            <div class="mt-4 flex items-center justify-center gap-2 text-xs text-slate-400 font-medium">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">verified_user</span>
                                <span>Koneksi Terenkripsi & Aman</span>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-6">
                            <p class="text-xs text-slate-400 font-normal">© 2026 KireiLibrary • UTS Pemrograman Web</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Toggle Password Visibility Script -->
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('librarian-password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (!passwordField || !eyeIcon) return;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordField.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
