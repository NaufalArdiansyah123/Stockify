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
    
    .user-avatar-large {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border-radius: 50%;
        font-size: 1.5rem;
    }
    
    .info-badge {
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid rgba(99, 102, 241, 0.2);
    }
</style>

<div class="p-6 max-w-4xl mx-auto space-y-6">
    {{-- Header Section --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="user-avatar-large w-16 h-16">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit User Profile</h1>
                    <div class="flex items-center space-x-2 mt-1">
                        <p class="text-gray-600 text-sm">Mengedit profil:</p>
                        <span class="info-badge">{{ $user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-500">User ID</div>
                <div class="font-bold text-gray-700">#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- User Info Card --}}
        <div class="lg:col-span-1">
            <div class="industrial-card rounded-2xl p-6 hover-lift space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-info-circle text-primary mr-2"></i>
                    Informasi User
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="text-gray-800 font-medium">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Role:</span>
                        <span class="role-badge role-{{ $user->role }}">
                            @if($user->role == 'admin')
                                <i class="fas fa-crown mr-1"></i>
                            @elseif($user->role == 'manager')
                                <i class="fas fa-user-tie mr-1"></i>
                            @else
                                <i class="fas fa-user mr-1"></i>
                            @endif
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created:</span>
                        <span class="text-gray-800">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Update:</span>
                        <span class="text-gray-800">{{ $user->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span class="text-green-600 text-sm font-semibold">Active User</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        <div class="lg:col-span-2">
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    
                    {{-- Personal Information --}}
                    <div class="space-y-4 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user-circle text-primary mr-2"></i>
                            Update Personal Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">
                                    <i class="fas fa-user text-primary"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       name="name" 
                                       class="form-input w-full px-4 py-3 rounded-xl text-gray-800"
                                       value="{{ old('name', $user->name) }}"
                                       required>
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
                                       class="form-input w-full px-4 py-3 rounded-xl text-gray-800"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Role Selection --}}
                    <div class="space-y-4 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-users-cog text-primary mr-2"></i>
                            Update Role & Permissions
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="role-option {{ $user->role == 'admin' ? 'selected' : '' }}" data-role="admin">
                                <input type="radio" name="role" value="admin" class="hidden" {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-crown text-red-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Administrator</h4>
                                    <p class="text-xs text-gray-600 mt-1">Full access</p>
                                </div>
                            </label>
                            
                            <label class="role-option {{ $user->role == 'manager' ? 'selected' : '' }}" data-role="manager">
                                <input type="radio" name="role" value="manager" class="hidden" {{ old('role', $user->role) == 'manager' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-user-tie text-yellow-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Manager</h4>
                                    <p class="text-xs text-gray-600 mt-1">Warehouse mgmt</p>
                                </div>
                            </label>
                            
                            <label class="role-option {{ $user->role == 'staff' ? 'selected' : '' }}" data-role="staff">
                                <input type="radio" name="role" value="staff" class="hidden" {{ old('role', $user->role) == 'staff' ? 'checked' : '' }}>
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-user text-green-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 text-sm">Staff</h4>
                                    <p class="text-xs text-gray-600 mt-1">Operations</p>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Section --}}
                    <div class="space-y-4 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt text-primary mr-2"></i>
                            Change Password (Optional)
                        </h3>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-info-circle text-yellow-600 mt-0.5"></i>
                                <div class="text-sm text-yellow-800">
                                    <p class="font-semibold">Password Update Notice</p>
                                    <p>Kosongkan field password jika tidak ingin mengubah password yang ada.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="form-label">
                                <i class="fas fa-lock text-primary"></i>
                                Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="form-input w-full px-4 py-3 pr-12 rounded-xl text-gray-800 placeholder-gray-500"
                                       placeholder="Masukkan password baru (opsional)">
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
                            <i class="fas fa-save"></i>
                            <span>Update User</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Add role badge styles --}}
<style>
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .role-admin {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .role-manager {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .role-staff {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
</style>

{{-- JavaScript for enhanced interactions --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            });
        });
        
        // Form animation on load
        const cards = document.querySelectorAll('.industrial-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });
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
    
    // Form submission enhancement
    document.getElementById('editUserForm').addEventListener('submit', function() {
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Updating...</span>';
        submitBtn.disabled = true;
    });
</script>
@endsection