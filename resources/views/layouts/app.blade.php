<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SM Game Store - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'game-primary': '#1a1a2e',
                        'game-secondary': '#16213e',
                        'game-accent': '#0f3460',
                        'game-purple': '#533483',
                        'game-pink': '#e94560',
                        'neon-blue': '#00f5ff',
                        'neon-purple': '#bf00ff',
                        'dark-bg': '#0d1117',
                        'dark-card': '#161b22'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #0d1117 0%, #1a1a2e 50%, #16213e 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .neon-glow {
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .neon-glow:hover {
            box-shadow: 0 0 30px rgba(0, 245, 255, 0.5);
            transform: translateY(-2px);
        }
        
        .sidebar-item {
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(45deg, #00f5ff, #bf00ff);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .sidebar-item.active:before,
        .sidebar-item:hover:before {
            transform: scaleY(1);
        }
        
        .gaming-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb);
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .pulse-dot {
            animation: pulseDot 2s ease-in-out infinite;
        }
        
        @keyframes pulseDot {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            background: rgba(0, 245, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(-60px) rotate(240deg); }
        }
        
        .content-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo-text {
            background: linear-gradient(45deg, #00f5ff, #bf00ff, #00f5ff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: logoShine 3s ease-in-out infinite;
        }
        
        @keyframes logoShine {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen overflow-hidden">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle w-1 h-1" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
        <div class="particle w-2 h-2" style="top: 20%; left: 80%; animation-delay: 1s;"></div>
        <div class="particle w-1 h-1" style="top: 60%; left: 20%; animation-delay: 2s;"></div>
        <div class="particle w-3 h-3" style="top: 80%; left: 70%; animation-delay: 3s;"></div>
        <div class="particle w-1 h-1" style="top: 40%; left: 90%; animation-delay: 4s;"></div>
        <div class="particle w-2 h-2" style="top: 70%; left: 10%; animation-delay: 5s;"></div>
    </div>

    <div class="min-h-screen flex relative z-10">
        <!-- Sidebar -->
        <aside class="w-72 glass-effect shadow-2xl relative">
            <!-- Logo Header -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <!-- Gaming Controller Icon -->
                    <div class="w-10 h-10 gaming-gradient rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.58 16.09l-1.09-7.66C20.21 6.46 18.52 5 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.2 17.63 3.39 19 4.94 19c.68 0 1.32-.27 1.8-.75L9 16h6l2.26 2.25c.48.48 1.12.75 1.8.75 1.55 0 2.74-1.37 2.52-2.91zM7.5 10.5C7.5 9.67 8.17 9 9 9s1.5.67 1.5 1.5S9.83 12 9 12s-1.5-.67-1.5-1.5zm9 0c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold logo-text">SM</h1>
                        <p class="text-xs text-gray-400">Game Store Admin</p>
                    </div>
                </div>
                <!-- Status Indicator -->
                <div class="mt-4 flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></div>
                    <span class="text-xs text-gray-300">System Online</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:text-neon-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="ml-auto w-2 h-2 bg-neon-blue rounded-full"></div>
                    @endif
                </a>

                <!-- Products -->
                <a href="{{ route('admin.products.index') }}"
                   class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:text-neon-purple transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="font-medium">Produk</span>
                    @if(request()->is('admin/products*'))
                        <div class="ml-auto w-2 h-2 bg-neon-purple rounded-full"></div>
                    @endif
                </a>

                <!-- Transactions -->
                <a href="{{ route('admin.transactions.index') }}"
                   class="sidebar-item {{ request()->is('admin/transactions*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium">Transaksi</span>
                    @if(request()->is('admin/transactions*'))
                        <div class="ml-auto w-2 h-2 bg-green-400 rounded-full"></div>
                    @endif
                </a>

                <!-- Logout Button -->
                <div class="pt-4 mt-6 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center space-x-3 w-full px-4 py-3 rounded-xl text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all duration-300 group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="glass-effect border-b border-white/10 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            @if(request()->routeIs('dashboard'))
                                Dashboard
                            @elseif(request()->is('admin/products*'))
                                Produk Management
                            @elseif(request()->is('admin/transactions*'))
                                Transaksi Management
                            @else
                                Admin Panel
                            @endif
                        </h2>
                        <p class="text-gray-400 text-sm">Manage your game store efficiently</p>
                    </div>
                    
                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-white font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                        <div class="w-10 h-10 gaming-gradient rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6 content-fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Additional JavaScript for interactions -->
    <script>
        // Add smooth scrolling and animation effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to sidebar items
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Add a small animation effect
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
            });

            // Add dynamic time display (optional)
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            console.log('Admin panel loaded at:', timeString);
        });
    </script>
</body>
</html>