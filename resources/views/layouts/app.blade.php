<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                        accent: '#06b6d4',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
            min-height: 100vh;
        }
        
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                8px 0 32px rgba(0, 0, 0, 0.1);
        }
        
        .glass-topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        
        .sidebar-logo {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
        
        .nav-section {
            position: relative;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .nav-section::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 2px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
            color: #6366f1;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 0 2px 2px 0;
        }
        
        .nav-icon {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
            transition: transform 0.3s ease;
        }
        
        .nav-link:hover .nav-icon {
            transform: scale(1.1);
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transition: transform 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        }
        
        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .status-indicator {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .main-content {
            background: transparent;
            min-height: 100vh;
        }
        
        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.625rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 0.25rem;
        }
        
        .role-admin {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .role-manager {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        
        .role-staff {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="flex">

    {{-- ENHANCED SIDEBAR --}}
    <aside class="w-72 glass-sidebar h-screen sticky top-0">
        <!-- Logo -->

           <div class="flex items-center space-x-3 px-4 py-3 border-b border-gray-200">
        @if($setting && $setting->logo)
            <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" class="h-10 w-10 object-contain">
        @else
        <div class="h-10 w-10 bg-blue-600 text-white flex items-center justify-center rounded-lg font-bold">
            {{ strtoupper(substr($setting->app_name ?? 'App', 0, 1)) }}
        </div>
    @endif
    <span class="text-xl font-extrabold tracking-wide text-gray-800">
        {{ $setting->app_name ?? 'Industrial IMS' }}
    </span>
</div>
        {{-- Navigation --}}
        <nav class="p-4 space-y-1">
            {{-- ADMIN ONLY --}}
            @if(auth()->user()->role === 'admin')
                <div class="nav-section">
                    <div class="text-gray-500 text-xs uppercase font-semibold tracking-wider pl-4 mb-2">
                        <i class="fas fa-crown mr-2"></i>Admin Control
                    </div>
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('users.index') }}" 
                       class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                    <a href="{{ route('categories.index') }}" 
                       class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags nav-icon"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('suppliers.index') }}" 
                       class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                        <i class="fas fa-truck nav-icon"></i>
                        <span>Supplier</span>
                    </a>
                    <a href="{{ route('settings.edit') }}" 
                       class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            @endif
            

            {{-- MANAGER & ADMIN --}}
            @if(in_array(auth()->user()->role, ['admin','manager']))
                <div class="nav-section">
                    <div class="text-gray-500 text-xs uppercase font-semibold tracking-wider pl-4 mb-2">
                        <i class="fas fa-warehouse mr-2"></i>Warehouse
                    </div>
                     @if(in_array(auth()->user()->role, ['manager']))
                    <a href="{{ route('manager.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                   <i class="fas fa-chart-line nav-icon"></i>
                   <span>Dashboard</span>
                    </a>
                    @endif
                        {{-- Manager can only VIEW suppliers --}}
                        @if(auth()->user()->role === 'manager')
                        <a href="{{ route('suppliers.index') }}" 
                        class="nav-link {{ request()->routeIs('suppliers.index') ? 'active' : '' }}">
                            <i class="fas fa-truck nav-icon"></i>
                            <span>Supplier</span>
                        </a>
                        @endif
                    <a href="{{ route('products.index') }}" 
                       class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes nav-icon"></i>
                        <span>Produk</span>
                    </a>
                    <a href="{{ route('stock.index') }}" 
                       class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list nav-icon"></i>
                        <span>Stok</span>
                    </a>
                    <a href="{{ route('reports.index') }}" 
                       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span>Laporan</span>
                    </a>
                </div>
            @endif

            {{-- STAFF --}}
            @if(auth()->user()->role === 'staff')
                <div class="nav-section">
                    <div class="text-gray-500 text-xs uppercase font-semibold tracking-wider pl-4 mb-2">
                        <i class="fas fa-tasks mr-2"></i>Operations
                    </div>
                    <a href="{{ route('staff.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('stock.index') }}" 
                       class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt nav-icon"></i>
                        <span>Transaksi Stok</span>
                    </a>
                </div>
            @endif

            {{-- ADMIN, MANAGER & STAFF --}}
            @if(in_array(auth()->user()->role, ['admin','manager','staff']))
                <div class="nav-section">
                    <div class="text-gray-500 text-xs uppercase font-semibold tracking-wider pl-4 mb-2">
                        <i class="fas fa-inventory mr-2"></i>Inventory
                    </div>
                    <a href="{{ route('stockopname.index') }}" 
                       class="nav-link {{ request()->routeIs('stockopname.*') ? 'active' : '' }}">
                        <i class="fas fa-search nav-icon"></i>
                        <span>Stock Opname</span>
                    </a>
                </div>
            @endif
        </nav>

        {{-- System Status --}}
        <div class="absolute bottom-4 left-4 right-4">
            <div class="glass-sidebar rounded-lg p-3 border border-gray-200/50">
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full status-indicator"></div>
                        <span class="text-gray-600">System Online</span>
                    </div>
                    <span class="text-gray-500">v2.0.1</span>
                </div>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col main-content">
        {{-- ENHANCED TOPBAR --}}
        <div class="glass-topbar">
            <div class="flex items-center justify-between px-6 py-4">
                {{-- Breadcrumb or Page Title --}}
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-500">
                        {{ now()->format('l, F j, Y') }}
                    </div>
                </div>

                {{-- User Section --}}
                <div class="flex items-center space-x-4">
                    {{-- Notifications --}}
                    <button class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- User Info --}}
                    <div class="flex items-center space-x-3">
                        <div class="user-avatar w-12 h-12 flex items-center justify-center rounded-full text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <div class="flex items-center space-x-1">
                                <span class="role-badge role-{{ Auth::user()->role }}">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit" class="logout-btn flex items-center space-x-2 text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="flex-1">
            @yield('content')
        </div>

        @stack('scripts')
    </div>

    {{-- Additional Scripts --}}
    <script>
        // Add active nav link highlighting
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Add smooth animations on load
            const sidebar = document.querySelector('aside');
            sidebar.style.transform = 'translateX(-100%)';
            sidebar.style.transition = 'transform 0.6s ease';
            
            setTimeout(() => {
                sidebar.style.transform = 'translateX(0)';
            }, 100);
        });

        // Real-time clock update
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            const dateString = now.toLocaleDateString('en-US', options);
            
            const dateElement = document.querySelector('.glass-topbar .text-gray-500');
            if (dateElement) {
                dateElement.textContent = dateString;
            }
        }

        // Update time every minute
        setInterval(updateTime, 60000);
    </script>
</body>
</html>