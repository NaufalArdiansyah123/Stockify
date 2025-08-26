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
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }
    
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
    
    .table-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(3px);
        transition: all 0.3s ease;
    }
    
    .user-avatar {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border-radius: 50%;
    }
    
    .stats-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="p-6 space-y-6">
    {{-- Header Section --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Kelola pengguna sistem inventory</p>
                </div>
            </div>
            <a href="{{ route('users.create') }}" 
               class="btn-primary flex items-center space-x-2 text-white px-6 py-3 rounded-xl font-medium">
                <i class="fas fa-user-plus"></i>
                <span>Tambah User</span>
            </a>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="stats-card rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $users->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="stats-card rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Admin</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $users->where('role', 'admin')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-crown text-red-600"></i>
                </div>
            </div>
        </div>
        
        <div class="stats-card rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Manager</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $users->where('role', 'manager')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-tie text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="stats-card rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Staff</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $users->where('role', 'staff')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="industrial-card rounded-2xl p-6 industrial-border">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                <p class="text-gray-600 text-sm">Manajemen akses pengguna sistem</p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-green-600 text-sm font-semibold">{{ $users->count() }} Active Users</span>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-gray-300">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100/70">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="table-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="user-avatar w-10 h-10 text-sm">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <span class="text-gray-800 font-medium">{{ $user->name }}</span>
                                        <div class="text-gray-500 text-xs">ID: #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                    <span class="text-gray-700">{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
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
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    <span class="text-green-600 text-sm font-semibold">Active</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="btn-warning flex items-center space-x-1 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                        <i class="fas fa-edit text-xs"></i>
                                        <span>Edit</span>
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-danger flex items-center space-x-1 text-white px-3 py-2 rounded-lg text-sm font-medium"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                            <i class="fas fa-trash text-xs"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-gray-400 text-xs px-3 py-2">Current User</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-2xl text-gray-400"></i>
                                    </div>
                                    <span class="text-gray-600 text-lg">No users found</span>
                                    <span class="text-gray-500 text-sm">Users will appear here when added</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- System Info Footer --}}
    <div class="industrial-card rounded-2xl p-4">
        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center space-x-6 text-gray-600">
                <span>Total Records: <strong class="text-gray-700">{{ $users->count() }}</strong></span>
                <span>Last Updated: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
            </div>
            <div class="text-gray-500">
                User Management System © 2024
            </div>
        </div>
    </div>
</div>

{{-- Add some JavaScript for enhanced interactions --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add staggered animation on load
        const cards = document.querySelectorAll('.hover-lift, .stats-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Enhanced table row interactions
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
                this.style.boxShadow = '0 4px 12px rgba(99, 102, 241, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endsection