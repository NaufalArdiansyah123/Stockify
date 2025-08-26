{{-- index.blade.php --}}
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
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-in {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-out {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        box-shadow: 
            0 10px 20px rgba(99, 102, 241, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(99, 102, 241, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .table-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(229, 231, 235, 0.5);
    }
    
    .table-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">📦</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Stock Transaction Management
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Inventory Control System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Real-time Tracking</span>
                    </div>
                   @auth
                @if(auth()->user()->role !== 'manager')
                    <a href="{{ route('suppliers.create') }}" class="industrial-button text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2 hover-lift">
                        Tambah Supplier
                    </a>
                 @endif
                 @endauth
                </div>
            </div>
        </div>

        {{-- Enhanced Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <span class="text-lg text-white">📈</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Total IN</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $movements->where('type', 'IN')->sum('quantity') }}</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                        <span class="text-lg text-white">📉</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Total OUT</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $movements->where('type', 'OUT')->sum('quantity') }}</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <span class="text-lg text-white">📋</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Transactions</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $movements->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                        <span class="text-lg text-white">⚡</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Today</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $movements->where('happened_at', '>=', today())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Transaction Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Stock Transaction History</h2>
                    <p class="text-gray-600 text-sm">Complete inventory movement records</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                    <span class="text-blue-600 text-sm font-semibold">Live Data</span>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-300">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100/70">
                            <tr>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Timestamp</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Product</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($movements as $m)
                            <tr class="table-row">
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                                        <div>
                                            <span class="text-gray-700 font-medium block">{{ $m->happened_at->format('d M Y') }}</span>
                                            <span class="text-gray-500 text-sm">{{ $m->happened_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">📦</span>
                                        </div>
                                        <span class="text-gray-800 font-medium">{{ $m->product->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="status-badge {{ $m->type == 'IN' ? 'status-in' : 'status-out' }}">
                                        {{ $m->type == 'IN' ? '↗ IN' : '↙ OUT' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-gray-800 font-bold text-lg">{{ $m->quantity }}</span>
                                    <span class="text-gray-500 text-sm ml-1">units</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs">👤</span>
                                        </div>
                                        <span class="text-gray-700">{{ $m->user->name ?? 'System' }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('stock.edit',$m->id) }}" 
                                           class="bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 hover:shadow-lg">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('stock.destroy',$m->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 hover:shadow-lg" 
                                                    onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                            <span class="text-2xl text-gray-400">📊</span>
                                        </div>
                                        <span class="text-gray-600 text-lg font-semibold">No transactions found</span>
                                        <span class="text-gray-500 text-sm">Stock movements will appear here</span>
                                        <a href="{{ route('stock.create') }}" 
                                           class="mt-4 industrial-button text-white px-6 py-3 rounded-xl font-semibold hover-lift">
                                            Create First Transaction
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Enhanced Pagination --}}
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Showing {{ $movements->firstItem() ?? 0 }} to {{ $movements->lastItem() ?? 0 }} of {{ $movements->total() ?? 0 }} results
                </div>
                <div class="industrial-card rounded-lg p-2">
                    {{ $movements->links() }}
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>System Status: <strong class="text-green-600">Operational</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Active Transactions: <strong class="text-gray-700">{{ $movements->count() }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Stock Management System © 2024
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
    });

    // Add real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        // Update any time display elements if they exist
    }
    
    setInterval(updateTime, 1000);
</script>
@endsection