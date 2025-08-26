<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stockify</title>
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
        .bg-gradient-dashboard {
            background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .slide-up {
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .input-focus {
            transition: all 0.3s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.1);
            animation: particles 20s linear infinite;
        }
        
        @keyframes particles {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full bg-gradient-dashboard overflow-hidden">
    <!-- Animated Particles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="particle w-2 h-2" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle w-3 h-3" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle w-1 h-1" style="left: 30%; animation-delay: 4s;"></div>
        <div class="particle w-2 h-2" style="left: 40%; animation-delay: 6s;"></div>
        <div class="particle w-1 h-1" style="left: 50%; animation-delay: 8s;"></div>
        <div class="particle w-3 h-3" style="left: 60%; animation-delay: 10s;"></div>
        <div class="particle w-2 h-2" style="left: 70%; animation-delay: 12s;"></div>
        <div class="particle w-1 h-1" style="left: 80%; animation-delay: 14s;"></div>
        <div class="particle w-2 h-2" style="left: 90%; animation-delay: 16s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 slide-up">
            <!-- Logo and Header -->
            <div class="text-center">
                <div class="floating">
                    <div class="mx-auto h-20 w-20 flex items-center justify-center">
                        <img src="{{ asset('storage/logos/logo.png') }}" alt="Logo" class="w-16 h-16 mx-auto">
                        </div>
                    </div>
                <h2 class="mt-6 text-4xl font-bold text-gray-900">
                    Stockify
                </h2>
                <p class="mt-2 text-lg text-gray-700">
                    Sistem Manajemen Inventory
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    Masuk ke akun Anda untuk melanjutkan
                </p>
            </div>

            <!-- Login Form -->
            <div class="glass-effect rounded-3xl shadow-2xl p-8">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-500"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                autocomplete="email" 
                                required 
                                class="input-focus appearance-none rounded-2xl relative block w-full pl-12 pr-4 py-4 bg-white/70 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white text-lg"
                                placeholder="Email address"
                                value="{{ old('email') }}"
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                required 
                                class="input-focus appearance-none rounded-2xl relative block w-full pl-12 pr-12 py-4 bg-white/70 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white text-lg"
                                placeholder="Password"
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center"
                                onclick="togglePassword()"
                            >
                                <i id="toggleIcon" class="fas fa-eye text-gray-500 hover:text-gray-700 transition-colors"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded bg-white"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-primary hover:text-secondary transition-colors">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="btn-hover group relative w-full flex justify-center py-4 px-4 border border-transparent text-lg font-medium rounded-2xl text-white bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-xl"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                <i class="fas fa-sign-in-alt text-white/80 group-hover:text-white"></i>
                            </span>
                            Masuk
                        </button>
                    </div>
                    {{-- Di bagian bawah form login --}}
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    © 2024 Stockify. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });
        });
    </script>
</body>
</html>