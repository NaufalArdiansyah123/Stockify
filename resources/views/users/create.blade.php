@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .industrial-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.05);
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    
    .industrial-border {
        position: relative;
        overflow: hidden;
    }
    
    .industrial-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #6366f1, transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(156, 163, 175, 0.3);
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        background: rgba(255, 255, 255, 0.9);
        border-color: #6366f1;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
        outline: none;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
    }
    
    .btn-secondary {
        background: rgba(107, 114, 128, 0.1);
        border: 2px solid rgba(107, 114, 128, 0.3);
        color: #374151;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: rgba(107, 114, 128, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
    }
    
    .role-option {
        padding: 1rem;
        border-radius: 0.75rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.5);
    }
    
    .role-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .role-option.selected {
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.1);
    }
    
    .floating-animation {
        animation: floating 6s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    
    .progress-bar {
        height: 4px;
        background: rgba(99, 102, 241, 0.2);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        transition: width 0.3s ease;
        width: 0%;
    }
</style>

<div class="p-6 max-w-2xl mx-auto space-y-6">
    {{-- Header Section --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center floating-animation">
                <i class="fas fa-user-plus text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
                <p class="text-gray-600 text-sm mt-1">Buat akun pengguna untuk sistem inventory</p>
            </div>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="progress-bar">
        <div class="progress-fill" id="progressBar"></div>
    </div>

    {{-- Form Section --}}
    <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6" id="userForm">
            @csrf
            
            {{-- Personal Information --}}
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-user-circle text-primary mr-2"></i>
                    Informasi Personal
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">
                            <i class="fas fa-user text-primary"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-input w-full px-4 py-3 rounded-xl text-gray-800 placeholder-gray-500"
                               placeholder="Masukkan nama lengkap"
                               required
                               value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="form-label">
                            <i class="fas fa-envelope text-primary"></i>
                            Email Address
                        </label>
                        <input type="email" 
                               name="email" 
                               class="form-input w-full px-4 py-3 rounded-xl text-gray-800 placeholder-gray-500"
                               placeholder="user@example.com"
                               required
                               value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Security Information --}}
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-shield-alt text-primary mr-2"></i>
                    Keamanan Akun
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">
                            <i class="fas fa-lock text-primary"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-input w-full px-4 py-3 pr-12 rounded-xl text-gray-800 placeholder-gray-500"
                                   placeholder="Minimal 8 karakter"
                                   required>
                            <button type="button" 
                                    onclick="togglePassword('password')"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary">
                                <i class="fas fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="form-label">
                            <i class="fas fa-lock text-primary"></i>
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="form-input w-full px-4 py-3 pr-12 rounded-xl text-gray-800 placeholder-gray-500"
                                   placeholder="Ulangi password"
                                   required>
                            <button type="button" 
                                    onclick="togglePassword('password_confirmation')"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary">
                                <i class="fas fa-eye" id="password_confirmationIcon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Role Selection --}}
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-users-cog text-primary mr-2"></i>
                    Role & Permissions
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="role-option" data-role="admin">
                        <input type="radio" name="role" value="admin" class="hidden" {{ old('role') == 'admin' ? 'checked' : '' }}>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-crown text-red-600 text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Administrator</h4>
                            <p class="text-sm text-gray-600 mt-1">Full system access</p>
                        </div>
                    </label>
                    
                    <label class="role-option" data-role="manager">
                        <input type="radio" name="role" value="manager" class="hidden" {{ old('role') == 'manager' ? 'checked' : '' }}>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user-tie text-yellow-600 text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Manager</h4>
                            <p class="text-sm text-gray-600 mt-1">Warehouse management</p>
                        </div>
                    </label>
                    
                    <label class="role-option" data-role="staff">
                        <input type="radio" name="role" value="staff" class="hidden" {{ old('role') == 'staff' ? 'checked' : '' }}>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user text-green-600 text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Staff</h4>
                            <p class="text-sm text-gray-600 mt-1">Operational tasks</p>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}" 
                   class="btn-secondary flex items-center space-x-2 px-6 py-3 rounded-xl font-medium">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                
                <button type="submit" 
                        class="btn-primary flex items-center space-x-2 text-white px-6 py-3 rounded-xl font-medium">
                    <i class="fas fa-user-plus"></i>
                    <span>Buat User</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Tips Section --}}
    <div class="industrial-card rounded-2xl p-6">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Tips Keamanan</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Password minimal 8 karakter dengan kombinasi huruf dan angka</li>
                    <li>• Admin memiliki akses penuh ke semua fitur sistem</li>
                    <li>• Manager dapat mengelola produk, stok, dan laporan</li>
                    <li>• Staff hanya dapat melakukan transaksi stok dan stock opname</li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for enhanced interactions --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form progress tracking
        const form = document.getElementById('userForm');
        const inputs = form.querySelectorAll('input[required]');
        const progressBar = document.getElementById('progressBar');
        
        function updateProgress() {
            let filledInputs = 0;
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filledInputs++;
                }
            });
            
            const progress = (filledInputs / inputs.length) * 100;
            progressBar.style.width = progress + '%';
        }
        
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        
        // Role selection
        const roleOptions = document.querySelectorAll('.role-option');
        roleOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                roleOptions.forEach(opt => opt.classList.remove('selected'));
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Check the radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                
                updateProgress();
            });
        });
        
        // Set initial selected role if any
        const checkedRadio = document.querySelector('input[name="role"]:checked');
        if (checkedRadio) {
            const roleOption = checkedRadio.closest('.role-option');
            roleOption.classList.add('selected');
        }
        
        // Form animation on load
        const cards = document.querySelectorAll('.industrial-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 200);
        });
        
        // Initial progress update
        updateProgress();
    });
    
    // Password toggle function
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + 'Icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Form validation enhancement
    document.getElementById('userForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak sama!');
            return false;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter!');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Membuat User...</span>';
        submitBtn.disabled = true;
    });
</script>
@endsection