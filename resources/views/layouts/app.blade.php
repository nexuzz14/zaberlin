<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Zaberlin TV - Platform streaming video podcast dan edukasi terbaik Indonesia')">
    <title>@yield('title', 'Zaberlin TV') | Streaming Podcast & Edukasi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-navy text-white font-inter antialiased min-h-screen">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 navbar-transparent">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group flex-shrink-0" id="nav-logo">
                    <div class="w-8 h-8 lg:w-9 lg:h-9 rounded-lg flex items-center justify-center zaberlin-gradient shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <span class="font-outfit font-900 text-lg lg:text-xl tracking-tight">
                        <span class="text-white">Zaberlin</span><span class="text-red-500"> TV</span>
                    </span>
                </a>

                <!-- Center Nav -->
                <div class="hidden md:flex items-center gap-1">
                    <!-- Beranda -->
                    <a href="{{ route('home') }}"
                       class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') && !request()->query('category') ? 'text-white bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                       id="nav-beranda">
                        Beranda
                    </a>

                    <!-- Kategori Dropdown -->
                    <div class="relative" id="kategori-dropdown-wrapper">
                        <button
                            class="nav-link px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-1.5 transition-all duration-200 {{ request()->query('category') ? 'text-white bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                            id="kategori-btn"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Kategori
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" id="kategori-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="kategori-menu"
                             class="hidden absolute top-full left-0 mt-2 w-44 rounded-xl border border-white/10 shadow-2xl overflow-hidden z-50"
                             style="background: rgba(4,4,64,0.97); backdrop-filter: blur(16px);">
                            <a href="{{ route('home', ['category' => 'podcast']) }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition-all duration-150 {{ request()->query('category') === 'podcast' ? 'text-white bg-red-600/20' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                               id="nav-podcast">
                                <span class="w-6 h-6 rounded-md bg-red-600/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2a3 3 0 0 1 3 3v6a3 3 0 0 1-6 0V5a3 3 0 0 1 3-3z"/>
                                        <path d="M19 11a7 7 0 0 1-14 0H3a9 9 0 0 0 18 0h-2z"/>
                                    </svg>
                                </span>
                                Podcast
                            </a>
                            <div class="h-px bg-white/5 mx-3"></div>
                            <a href="{{ route('home', ['category' => 'edukasi']) }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition-all duration-150 {{ request()->query('category') === 'edukasi' ? 'text-white bg-blue-600/20' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                               id="nav-edukasi">
                                <span class="w-6 h-6 rounded-md bg-blue-600/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                                    </svg>
                                </span>
                                Edukasi
                            </a>
                            <div class="h-px bg-white/5 mx-3"></div>
                            <a href="{{ route('home', ['category' => 'variety show']) }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition-all duration-150 {{ request()->query('category') === 'variety show' ? 'text-white bg-purple-600/20' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                               id="nav-variety-show">
                                <span class="w-6 h-6 rounded-md bg-purple-600/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </span>
                                Variety Show
                            </a>
                            <div class="h-px bg-white/5 mx-3"></div>
                            <a href="{{ route('home', ['category' => 'iklan komersial']) }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition-all duration-150 {{ request()->query('category') === 'iklan komersial' ? 'text-white bg-yellow-600/20' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
                               id="nav-iklan-komersial">
                                <span class="w-6 h-6 rounded-md bg-yellow-600/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </span>
                                Iklan Komersial
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right -->
                <div class="flex items-center gap-2.5">
                    <!-- Upload Button -->
                    <a href="{{ route('video.upload') }}"
                       class="hidden sm:flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-red-600 hover:bg-red-700 text-white transition-all duration-200 shadow-lg hover:shadow-red-600/30 hover:scale-105"
                       id="nav-upload">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Upload
                    </a>

                    <!-- Profile icon -->
                    <button class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-navy-dark flex items-center justify-center hover:scale-110 transition-transform duration-200 border-2 border-blue-400/30 flex-shrink-0"
                            id="profile-btn"
                            aria-label="Profil pengguna">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </button>

                    <!-- Mobile menu -->
                    <button class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/10 transition-colors" id="mobile-menu-btn" aria-label="Menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4 border-t border-white/10 mt-2 pt-4">
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all">Beranda</a>
                    <p class="px-4 pt-2 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-widest">Kategori</p>
                    <a href="{{ route('home', ['category' => 'podcast']) }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all pl-6">🎙 Podcast</a>
                    <a href="{{ route('home', ['category' => 'edukasi']) }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all pl-6">📚 Edukasi</a>
                    <a href="{{ route('home', ['category' => 'variety show']) }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all pl-6">🎭 Variety Show</a>
                    <a href="{{ route('home', ['category' => 'iklan komersial']) }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all pl-6">🎬 Iklan Komersial</a>
                    <a href="{{ route('video.upload') }}" class="px-4 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:text-white hover:bg-red-600/20 transition-all">+ Upload Video</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="fixed top-20 right-4 z-50 bg-green-600 text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in" id="success-toast">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-2 opacity-70 hover:opacity-100">×</button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 border-t border-white/10 py-10 px-4">
        <div class="max-w-screen-2xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg zaberlin-gradient flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <span class="font-outfit font-bold text-lg"><span class="text-white">Zaberlin</span><span class="text-red-500"> TV</span></span>
                </div>
                <p class="text-slate-500 text-sm">© {{ date('Y') }} Zaberlin TV · zaberlintv.my.id · Semua hak dilindungi</p>
                <div class="flex gap-4 text-slate-500 text-sm">
                    <a href="#" class="hover:text-white transition-colors">Tentang</a>
                    <a href="#" class="hover:text-white transition-colors">Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 80) {
                navbar.style.background = 'rgba(6, 6, 93, 0.98)';
                navbar.style.backdropFilter = 'blur(12px)';
                navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.4)';
            } else {
                navbar.style.background = 'linear-gradient(180deg, rgba(6,6,93,0.95) 0%, transparent 100%)';
                navbar.style.backdropFilter = 'none';
                navbar.style.boxShadow = 'none';
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Kategori dropdown toggle
        const kategoriBtn = document.getElementById('kategori-btn');
        const kategoriMenu = document.getElementById('kategori-menu');
        const kategoriChevron = document.getElementById('kategori-chevron');

        kategoriBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isHidden = kategoriMenu.classList.contains('hidden');
            kategoriMenu.classList.toggle('hidden', !isHidden);
            kategoriChevron.style.transform = isHidden ? 'rotate(180deg)' : '';
            kategoriBtn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
        });

        // Close dropdown on outside click
        document.addEventListener('click', () => {
            kategoriMenu.classList.add('hidden');
            kategoriChevron.style.transform = '';
            kategoriBtn.setAttribute('aria-expanded', 'false');
        });

        // Auto-dismiss success toast
        const toast = document.getElementById('success-toast');
        if (toast) setTimeout(() => toast.remove(), 4000);
    </script>
    @stack('scripts')
</body>
</html>
