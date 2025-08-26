@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .bg-gradient-dashboard {
        background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
        min-height: 100vh;
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.05);
    }
    
    .industrial-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.05);
    }
    
    .floating-animation {
        animation: floating 6s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .pulse-glow {
        animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        50% { 
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
        }
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
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
    
    .metric-icon {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        box-shadow: 
            0 10px 20px rgba(99, 102, 241, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .activity-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        backdrop-filter: blur(10px);
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-color: rgba(245, 158, 11, 0.3);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-color: rgba(239, 68, 68, 0.3);
    }
    
    .supplier-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .supplier-table th {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        border-bottom: 2px solid rgba(99, 102, 241, 0.2);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #374151;
    }
    
    .supplier-table tr:hover {
        background: rgba(99, 102, 241, 0.03);
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">🏭</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Supplier Management
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Supply Chain Control</p>
                    </div>
                </div>
                <div class="text-right"> 
                  
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">{{ count($suppliers) }} Active Suppliers</span>
                    </div>
                    @auth
                @if(auth()->user()->role !== 'manager')
                    <a href="{{ route('suppliers.create') }}" class="action-btn btn-primary">
                        Tambah Supplier
                    </a>
                 @endif
                 @endauth
                </div>
            </div>
        </div>

        {{-- Statistics Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <span class="text-2xl text-white">📊</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm uppercase tracking-wide">Total Suppliers</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ count($suppliers) }}</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                        <span class="text-2xl text-white">🌐</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm uppercase tracking-wide">Supply Network</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">Active</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                        <span class="text-2xl text-white">⚡</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm uppercase tracking-wide">System Status</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">Online</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Supplier Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Supplier Directory</h2>
                    <p class="text-gray-600 text-sm">Complete supplier information and management</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-semibold">Real-time Data</span>
                </div>
            </div>
            
            <div class="overflow-hidden rounded-xl border border-gray-300">
                <div class="overflow-x-auto">
                    <table class="supplier-table min-w-full">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <span>🏢</span>
                                        <span>Supplier Name</span>
                                    </div>
                                </th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <span>📞</span>
                                        <span>Contact Info</span>
                                    </div>
                                </th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <span>📍</span>
                                        <span>Address</span>
                                    </div>
                                </th>
                                <th class="py-4 px-6 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center justify-center space-x-2">
                                        <span>⚙️</span>
                                        <span>Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($suppliers as $supplier)
                            <tr class="activity-row">
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-400 rounded-full mr-3"></div>
                                        <div>
                                            <span class="text-gray-800 font-semibold text-lg">{{ $supplier->name }}</span>
                                            <div class="text-gray-500 text-xs">ID: SUP-{{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <span class="text-gray-800 font-medium">
                                            {{ $supplier->contact_person ?: $supplier->phone ?: 'No contact info' }}
                                        </span>
                                        @if($supplier->phone && $supplier->contact_person)
                                            <div class="text-gray-500 text-xs mt-1">
                                                Phone: {{ $supplier->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-gray-700">{{ $supplier->address ?: 'No address provided' }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center space-x-3">
                                          @if(auth()->user()->role !== 'manager')
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="action-btn btn-edit">
                                            <span class="mr-1">✏️</span>
                                            Edit
                                        </a>
                                        @endif
                                          @if(auth()->user()->role !== 'manager')
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to remove this supplier from the system?')" class="action-btn btn-delete">
                                                <span class="mr-1">🗑️</span>
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4 pulse-glow">
                                            <span class="text-2xl text-gray-400">🏭</span>
                                        </div>
                                        <span class="text-gray-600 text-lg font-semibold">No Suppliers Found</span>
                                        <span class="text-gray-500 text-sm mb-4">Start building your supply network</span>
                                        <a href="{{ route('suppliers.create') }}" class="action-btn btn-primary">
                                            <span class="mr-2">➕</span>
                                            Add First Supplier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Supplier Module: <strong class="text-green-600">Operational</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Total Records: <strong class="text-gray-700">{{ count($suppliers) }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Supply Chain Management © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add subtle animations on load
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.hover-lift');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }, index * 100);
        });
        
        // Add hover effect for table rows
        const tableRows = document.querySelectorAll('.activity-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
                this.style.background = 'rgba(99, 102, 241, 0.05)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
                this.style.background = 'transparent';
            });
        });
    });
    
    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        // Update any time display elements if they exist
    }
    
    setInterval(updateTime, 1000);
</script>
@endsection