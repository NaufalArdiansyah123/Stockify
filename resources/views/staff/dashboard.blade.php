{{-- resources/views/staff/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .bg-gradient-dashboard {
        background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
        min-height: 100vh;
    }
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
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
    
    .task-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 15px 20px -5px rgba(0, 0, 0, 0.1);
    }
    
    .task-item {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: all 0.3s ease;
    }
    
    .task-item:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateX(5px);
        box-shadow: 0 10px 15px -5px rgba(0, 0, 0, 0.1);
    }
    
    .priority-high {
        border-left: 4px solid #ef4444;
    }
    
    .badge-urgent {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .notification-dot {
        width: 12px;
        height: 12px;
        background: #ef4444;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }
    
    .task-progress {
        height: 6px;
        background-color: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        width: 60%;
    }
    
    .task-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #6366f1);
        border-radius: 3px;
        transition: width 0.3s ease;
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
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">👷</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Staff Control Panel
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Stock Confirmation Management System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Active Shift</span>
                    </div>
                    <span class="text-lg text-gray-800">Welcome, {{ Auth::user()->name }} 👋</span>
                    <div class="text-xs text-gray-500 mt-1">Role: Staff Member</div>
                </div>
            </div>
        </div>

        {{-- Task Overview Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            <span class="text-lg text-white">📥</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs uppercase tracking-wide">Pending In</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pendingRequests->where('type', 'IN')->count() }}</p>
                        </div>
                    </div>
                    @if($pendingRequests->where('type', 'IN')->count() > 0)
                    <div class="notification-dot"></div>
                    @endif
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <span class="text-lg text-white">📤</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs uppercase tracking-wide">Pending Out</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pendingRequests->where('type', 'OUT')->count() }}</p>
                        </div>
                    </div>
                    @if($pendingRequests->where('type', 'OUT')->count() > 0)
                    <div class="notification-dot"></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Task Lists Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Incoming Stock Tasks --}}
            <div class="task-card rounded-2xl p-6 industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            <span class="text-xl text-white">📥</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Barang Masuk</h3>
                            <p class="text-gray-600 text-sm">Items to be checked and verified</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
                        <span class="text-red-600 text-sm font-semibold">{{ $pendingRequests->where('type', 'IN')->count() }} Pending</span>
                    </div>
                </div>
                
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($pendingRequests->where('type', 'IN') as $request)
                    <div class="task-item p-4 rounded-xl priority-high">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <span class="font-semibold text-gray-800">{{ $request->product->name }}</span>
                            </div>
                            <span class="badge-urgent">Urgent</span>
                        </div>
                        <div class="text-sm text-gray-600 mb-3">
                            <p>Quantity: <strong>{{ $request->quantity }} units</strong></p>
                            <p>Requested by: {{ $request->requester->name }} | {{ $request->created_at->format('d M Y, H:i') }}</p>
                            @if($request->note)
                            <p class="mt-1">Note: {{ $request->note }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="task-progress">
                                <div class="task-progress-bar" style="width: 0%"></div>
                            </div>
                            <form action="{{ route('staff.confirm', $request->id) }}" method="POST" class="flex space-x-2">
                                @csrf
                                <button type="submit" name="action" value="approve" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-xs rounded-lg transition-colors">
                                    Approve
                                </button>
                                <button type="submit" name="action" value="reject" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition-colors">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl text-gray-400">📥</span>
                        </div>
                        <p class="text-gray-500">No incoming stock requests.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Outgoing Stock Tasks --}}
            <div class="task-card rounded-2xl p-6 industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <span class="text-xl text-white">📤</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Barang Keluar</h3>
                            <p class="text-gray-600 text-sm">Items to be prepared and dispatched</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                        <span class="text-orange-600 text-sm font-semibold">{{ $pendingRequests->where('type', 'OUT')->count() }} Pending</span>
                    </div>
                </div>
                
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($pendingRequests->where('type', 'OUT') as $request)
                    <div class="task-item p-4 rounded-xl priority-high">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <span class="font-semibold text-gray-800">{{ $request->product->name }}</span>
                            </div>
                            <span class="badge-urgent">Urgent</span>
                        </div>
                        <div class="text-sm text-gray-600 mb-3">
                            <p>Quantity: <strong>{{ $request->quantity }} units</strong></p>
                            <p>Requested by: {{ $request->requester->name }} | {{ $request->created_at->format('d M Y, H:i') }}</p>
                            @if($request->note)
                            <p class="mt-1">Note: {{ $request->note }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="task-progress">
                                <div class="task-progress-bar" style="width: 0%"></div>
                            </div>
                            <form action="{{ route('staff.confirm', $request->id) }}" method="POST" class="flex space-x-2">
                                @csrf
                                <button type="submit" name="action" value="approve" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-xs rounded-lg transition-colors">
                                    Approve
                                </button>
                                <button type="submit" name="action" value="reject" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition-colors">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl text-gray-400">📤</span>
                        </div>
                        <p class="text-gray-500">No outgoing stock requests.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Activity Section --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Recent Confirmations</h2>
                    <p class="text-gray-600 text-sm">Your latest approval activities</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-semibold">Live Updates</span>
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
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                       @php
                                    $recentConfirmations = App\Models\StockMovement::where('user_id', auth()->id())
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get();
                                @endphp

                                @forelse($recentConfirmations as $confirmation)
                                <tr class="activity-row">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                                            <span class="text-gray-700 font-medium">{{ $confirmation->created_at->format('d M Y') }}</span>
                                            <span class="text-gray-500 text-sm ml-2">{{ $confirmation->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-gray-800 font-medium">{{ $confirmation->product->name ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="status-badge {{ $confirmation->type == 'IN' ? 'status-in' : 'status-out' }}">
                                            {{ $confirmation->type == 'IN' ? '↗ IN' : '↙ OUT' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-gray-800 font-bold text-lg">{{ $confirmation->quantity }}</span>
                                        <span class="text-gray-500 text-sm ml-1">units</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($confirmation->status == 'approved')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-semibold">Approved</span>
                                        @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs rounded-full font-semibold">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                                <span class="text-2xl text-gray-400">📊</span>
                                            </div>
                                            <span class="text-gray-600 text-lg">No recent confirmations</span>
                                            <span class="text-gray-500 text-sm">Your approval activities will appear here</span>
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
                    <span>Shift Status: <strong class="text-green-600">Active</strong></span>
                    <span>Last Activity: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Tasks Completed Today: <strong class="text-blue-600">{{ $pendingRequests->where('status', '!=', 'pending')->count() }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Staff Dashboard v2.0.1 | Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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
        
        // Animate progress bars
        const progressBars = document.querySelectorAll('.task-progress-bar');
        progressBars.forEach(bar => {
            setTimeout(() => {
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = '30%';
                }, 300);
            }, 500);
        });
    });
</script>
@endpush
@endsection