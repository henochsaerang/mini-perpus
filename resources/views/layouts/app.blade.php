<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 font-sans antialiased selection:bg-sky-500 selection:text-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mini-Perpus') — System Inventaris Perpustakaan</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0284c7',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js CDN (Interactive Components & Dropdowns) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="h-full text-slate-800 bg-slate-50" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex bg-slate-50">
        
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" 
             style="display: none;"></div>

        <!-- Sidebar / Navigation Drawer -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col justify-between transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0 border-r border-slate-800"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div>
                <!-- Brand Logo Area -->
                <div class="h-16 flex items-center px-6 bg-slate-950/80 border-b border-slate-800/80">
                    <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-book-bookmark text-base"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold tracking-tight text-white leading-tight">MiniPerpus</span>
                            <span class="text-[10px] font-medium text-slate-400 tracking-wider uppercase">Enterprise Admin</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5">
                    <div class="px-3 pb-2 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        Menu Utama
                    </div>

                    <!-- Link Kategori Buku -->
                    <a href="{{ route('categories.index') }}" 
                       class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-sky-600 text-white shadow-sm shadow-sky-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                        <i class="fa-solid fa-layer-group w-5 text-center text-sm"></i>
                        <span>Kategori Buku</span>
                    </a>

                    <!-- Link Katalog Buku -->
                    <a href="{{ route('books.index') }}" 
                       class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('books.*') ? 'bg-sky-600 text-white shadow-sm shadow-sky-600/30' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                        <i class="fa-solid fa-book w-5 text-center text-sm"></i>
                        <span>Katalog Buku</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom User Profile Card -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">
                <div class="flex items-center space-x-3 px-2 py-1.5">
                    <div class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-400 font-bold text-xs flex items-center justify-center border border-sky-500/30">
                        AD
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-slate-200 truncate">Admin Perpustakaan</p>
                        <p class="text-[10px] text-slate-500 truncate">admin@unima.ac.id</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Top Navbar Header -->
            <header class="h-16 bg-white border-b border-slate-200/80 shadow-xs flex items-center justify-between px-4 md:px-8 z-10">
                
                <div class="flex items-center space-x-4">
                    <!-- Mobile Hamburger Button -->
                    <button @click="sidebarOpen = !sidebarOpen" 
                            type="button" 
                            class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    <!-- Dynamic Page Title -->
                    <h1 class="text-sm md:text-base font-bold text-slate-800">
                        @yield('page_title', 'Dashboard System')
                    </h1>
                </div>

               
            </header>

            <!-- Main Workspace Area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-7xl mx-auto space-y-5">

                    <!-- Flash Messages (Success Alert) -->
                    @if (session('success'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 shadow-xs flex items-start space-x-3 text-emerald-900">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-base mt-0.5"></i>
                            <div class="flex-1 text-xs font-semibold leading-relaxed">
                                {{ session('success') }}
                            </div>
                            <button @click="show = false" type="button" class="text-emerald-500 hover:text-emerald-700">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Flash Messages (Error Alert) -->
                    @if (session('error'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="p-4 rounded-2xl bg-rose-50 border border-rose-200/80 shadow-xs flex items-start space-x-3 text-rose-900">
                            <i class="fa-solid fa-circle-xmark text-rose-500 text-base mt-0.5"></i>
                            <div class="flex-1 text-xs font-semibold leading-relaxed">
                                {{ session('error') }}
                            </div>
                            <button @click="show = false" type="button" class="text-rose-500 hover:text-rose-700">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Dynamic Page Content -->
                    @yield('content')

                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200/80 px-6 py-4 text-center md:text-left text-xs text-slate-500 flex flex-col md:flex-row justify-between items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} <span class="font-semibold text-slate-700">Mini-Perpus System</span>. All rights reserved.
                </div>
                <div class="text-[11px] font-medium text-slate-400">
                    Framework Programming — S1 Teknik Informatika UNIMA
                </div>
            </footer>

        </div>
    </div>

    @stack('scripts')
</body>
</html>