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
    
    .status-pending {
        background: rgba(251, 191, 36, 0.2);
        color: #f59e0b;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }
    
    .status-approved {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-rejected {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
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
    
    .btn-approve {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
    }
    
    .btn-approve:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(16, 185, 129, 0.4);
    }
    
    .btn-reject {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
    }
    
    .btn-reject:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(239, 68, 68, 0.4);
    }
    
    .priority-high {
        border-left: 4px solid #ef4444;
        background: rgba(239, 68, 68, 0.05);
    }
    
    .priority-normal {
        border-left: 4px solid #3b82f6;
        background: rgba(59, 130, 246, 0.05);
    }
    
    .priority-low {
        border-left: 4px solid #10b981;
        background: rgba(16, 185, 129, 0.05);
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="industrial-card rounded-2xl p-4 border-l-4 border-green-500 bg-green-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-green-400 text-xl">✓</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="industrial-card rounded-2xl p-4 border-l-4 border-red-500 bg-red-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-red-400 text-xl">⚠</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">🔍</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Staff Control Panel
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Stock Confirmation & Quality Control System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Real-time Tracking</span>
                    </div>
                    <span class="text-lg text-gray-800">Welcome, {{ Auth::user()->name }} 👷‍♂️</span>
                </div>
            </div>
        </div>

        {{-- Task Overview Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <span class="text-2xl text-white">⏳</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs uppercase tracking-wide">Pending Requests</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalPending }}</p>
                            <p class="text-xs text-orange-600 mt-1">Awaiting Review</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Priority Items</div>
                        @if($totalPending > 10)
                            <div class="text-red-600 text-sm font-semibold animate-pulse">High Volume</div>
                        @elseif($totalPending > 5)
                            <div class="text-yellow-600 text-sm font-semibold">Moderate</div>
                        @else
                            <div class="text-green-600 text-sm font-semibold">Normal</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <span class="text-2xl text-white">✅</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs uppercase tracking-wide">Approved Today</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalApproved }}</p>
                            <p class="text-xs text-green-600 mt-1">Confirmed Items</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Processing Rate</div>
                        <div class="text-green-600 text-sm font-semibold">
                            {{ $totalApproved > 0 ? round(($totalApproved / ($totalApproved + $totalRejected + $totalPending)) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            <span class="text-2xl text-white">❌</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs uppercase tracking-wide">Rejected Today</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalRejected }}</p>
                            <p class="text-xs text-red-600 mt-1">Quality Issues</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Rejection Rate</div>
                        <div class="text-red-600 text-sm font-semibold">
                            {{ ($totalApproved + $totalRejected) > 0 ? round(($totalRejected / ($totalApproved + $totalRejected)) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Action Summary --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Stock In Requests --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 rounded-xl bg-green-100">
                            <span class="text-xl text-green-600">📦</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Incoming Stock</h3>
                            <p class="text-gray-600 text-sm">Items awaiting receipt confirmation</p>
                        </div>
                    </div>
                    <span class="status-badge status-in">
                        {{ $pendingConfirmations->where('type', 'IN')->count() }} Pending
                    </span>
                </div>
                <div class="space-y-2">
                    @forelse($pendingConfirmations->where('type', 'IN')->take(3) as $item)
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-800 font-medium">{{ $item->product->name ?? 'Unknown' }}</span>
                            </div>
                            <span class="text-green-600 font-bold">+{{ $item->quantity }}</span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">No incoming stock pending</div>
                    @endforelse
                </div>
            </div>

            {{-- Stock Out Requests --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 rounded-xl bg-red-100">
                            <span class="text-xl text-red-600">📤</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Outgoing Stock</h3>
                            <p class="text-gray-600 text-sm">Items awaiting dispatch confirmation</p>
                        </div>
                    </div>
                    <span class="status-badge status-out">
                        {{ $pendingConfirmations->where('type', 'OUT')->count() }} Pending
                    </span>
                </div>
                <div class="space-y-2">
                    @forelse($pendingConfirmations->where('type', 'OUT')->take(3) as $item)
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <span class="text-gray-800 font-medium">{{ $item->product->name ?? 'Unknown' }}</span>
                            </div>
                            <span class="text-red-600 font-bold">-{{ $item->quantity }}</span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">No outgoing stock pending</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Enhanced Pending Confirmations Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Stock Confirmation Queue</h2>
                    <p class="text-gray-600 text-sm">Review and approve/reject pending stock movements</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                        <span class="text-orange-600 text-sm font-semibold">{{ $totalPending }} Items Pending</span>
                    </div>
                    <div class="text-xs text-gray-500">
                        Auto-refresh: <span class="font-bold text-gray-700">30s</span>
                    </div>
                </div>
            </div>
            
            <div class="overflow-hidden rounded-xl border border-gray-300">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100/70">
                            <tr>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Priority</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Product Info</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Movement Type</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Requester</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Request Time</th>
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Notes</th>
                                <th class="py-4 px-6 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pendingConfirmations as $confirmation)
                                @php
                                    $hoursOld = \Carbon\Carbon::parse($confirmation->created_at)->diffInHours(now());
                                    $priorityClass = $hoursOld > 24 ? 'priority-high' : ($hoursOld > 8 ? 'priority-normal' : 'priority-low');
                                    $priorityIcon = $hoursOld > 24 ? '🔴' : ($hoursOld > 8 ? '🟡' : '🟢');
                                    $priorityText = $hoursOld > 24 ? 'HIGH' : ($hoursOld > 8 ? 'NORMAL' : 'LOW');
                                @endphp
                                <tr class="activity-row {{ $priorityClass }}">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <span class="mr-2">{{ $priorityIcon }}</span>
                                            <span class="text-xs font-bold {{ $hoursOld > 24 ? 'text-red-600' : ($hoursOld > 8 ? 'text-yellow-600' : 'text-green-600') }}">
                                                {{ $priorityText }}
                                            </span>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $hoursOld }}h old</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">{{ substr($confirmation->product->name ?? 'N/A', 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-800 font-medium">{{ $confirmation->product->name ?? 'Unknown Product' }}</span>
                                                <div class="text-xs text-gray-500">ID: {{ $confirmation->product_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="status-badge {{ $confirmation->type == 'IN' ? 'status-in' : 'status-out' }}">
                                            {{ $confirmation->type == 'IN' ? '↗ INCOMING' : '↙ OUTGOING' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <span class="text-2xl font-bold {{ $confirmation->type == 'IN' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $confirmation->type == 'IN' ? '+' : '-' }}{{ $confirmation->quantity }}
                                            </span>
                                            <span class="text-gray-500 text-sm ml-1">units</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-gray-700">{{ substr($confirmation->requester->name ?? 'N/A', 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-800 font-medium">{{ $confirmation->requester->name ?? 'Unknown' }}</span>
                                                <div class="text-xs text-gray-500">{{ $confirmation->requester->role ?? 'Staff' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="text-gray-800 font-medium">{{ $confirmation->created_at->format('d M Y') }}</div>
                                        <div class="text-gray-500 text-sm">{{ $confirmation->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="max-w-xs">
                                            <span class="text-gray-600 text-sm">{{ $confirmation->note ?? 'No additional notes provided' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center space-x-2">
                                            <form action="{{ route('staff.confirm', $confirmation->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" name="action" value="approve" 
                                                    class="btn-approve" title="Approve this request">
                                                    ✓ Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('staff.confirm', $confirmation->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" name="action" value="reject" 
                                                    class="btn-reject" title="Reject this request">
                                                    ✗ Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                                <span class="text-2xl text-gray-400">✅</span>
                                            </div>
                                            <span class="text-gray-600 text-lg">No pending confirmations</span>
                                            <span class="text-gray-500 text-sm">All requests have been processed</span>
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
                    <span>Staff Panel Status: <strong class="text-green-600">Active</strong></span>
                    <span>Last Refresh: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Version: <strong class="text-gray-700">v2.0.1</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024 | Staff Module
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Auto Refresh Script --}}
<script>
    // Auto-refresh setiap 30 detik
    setInterval(function() {
        location.reload();
    }, 30000);
    
    // Add loading states to buttons
    document.querySelectorAll('form button').forEach(button => {
        button.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = this.innerHTML.includes('Approve') ? 
                '<span class="animate-spin">⏳</span> Processing...' : 
                '<span class="animate-spin">⏳</span> Processing...';
        });
    });
    
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
</script>
@endsection