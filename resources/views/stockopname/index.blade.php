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
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        color: white;
    }
    
    .activity-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(5px);
        transition: all 0.3s ease;
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
    
    .status-positive {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-negative {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .status-neutral {
        background: rgba(99, 102, 241, 0.2);
        color: #6366f1;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }
    
    .table-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        backdrop-filter: blur(10px);
    }
    
    .variance-positive {
        color: #10b981;
        font-weight: 700;
    }
    
    .variance-negative {
        color: #ef4444;
        font-weight: 700;
    }
    
    .variance-zero {
        color: #6366f1;
        font-weight: 700;
    }
    
    .data-cell {
        font-weight: 500;
        color: #374151;
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">📊</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Stock Opname Records
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Physical Inventory Audit Management System</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right mr-4">
                        <div class="flex items-center space-x-2 text-gray-700 mb-1">
                            <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                            <span class="text-sm">System Online</span>
                        </div>
                        <span class="text-lg text-gray-800">Total Records: {{ count($opnames) }}</span>
                    </div>
                    <a href="{{ route('stockopname.create') }}" 
                       class="px-6 py-3 rounded-xl industrial-button hover-lift">
                        ➕ New Audit
                    </a>
                </div>
            </div>
        </div>

        {{-- Enhanced Data Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Audit Records Database</h2>
                    <p class="text-gray-600 text-sm">Comprehensive inventory variance tracking</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                    <span class="text-blue-600 text-sm font-semibold">Live Data</span>
                </div>
            </div>
            
            <div class="overflow-hidden rounded-xl border border-gray-300">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    🏷️ Product Details
                                </th>
                                <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    💻 System Stock
                                </th>
                                <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    📦 Physical Count
                                </th>
                                <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    ⚖️ Variance
                                </th>
                                <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    👤 Auditor
                                </th>
                                <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    ⏰ Timestamp
                                </th>
                                <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    📝 Notes
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($opnames as $op)
                            <tr class="activity-row">
                                {{-- Product Details --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                        <div>
                                            <span class="text-gray-800 font-bold text-base">{{ $op->product->name }}</span>
                                            <div class="text-gray-500 text-sm">SKU: {{ $op->product->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- System Stock --}}
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-gray-100">
                                        <span class="data-cell text-lg">{{ number_format($op->system_stock) }}</span>
                                        <span class="text-gray-500 text-sm ml-1">units</span>
                                    </div>
                                </td>
                                
                                {{-- Physical Count --}}
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-blue-50">
                                        <span class="data-cell text-lg text-blue-700">{{ number_format($op->real_stock) }}</span>
                                        <span class="text-blue-500 text-sm ml-1">units</span>
                                    </div>
                                </td>
                                
                                {{-- Variance --}}
                                <td class="py-4 px-6 text-center">
                                    @php
                                        $variance = $op->difference;
                                        $varianceClass = $variance > 0 ? 'variance-positive' : ($variance < 0 ? 'variance-negative' : 'variance-zero');
                                        $statusClass = $variance > 0 ? 'status-positive' : ($variance < 0 ? 'status-negative' : 'status-neutral');
                                        $icon = $variance > 0 ? '📈' : ($variance < 0 ? '📉' : '⚖️');
                                    @endphp
                                    <div class="flex flex-col items-center">
                                        <span class="{{ $varianceClass }} text-xl">{{ $variance > 0 ? '+' : '' }}{{ number_format($variance) }}</span>
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $icon }} {{ $variance > 0 ? 'Surplus' : ($variance < 0 ? 'Shortage' : 'Match') }}
                                        </span>
                                    </div>
                                </td>
                                
                                {{-- Auditor --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                            {{ strtoupper(substr($op->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="data-cell">{{ $op->user->name }}</span>
                                            <div class="text-gray-500 text-sm">Auditor</div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Timestamp --}}
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="data-cell text-sm">{{ $op->created_at->format('d M Y') }}</span>
                                        <span class="text-gray-500 text-sm">{{ $op->created_at->format('H:i:s') }}</span>
                                        <span class="text-gray-400 text-xs">{{ $op->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>
                                
                                {{-- Notes --}}
                                <td class="py-4 px-6">
                                    <div class="max-w-xs">
                                        @if($op->note)
                                            <p class="text-gray-700 text-sm line-clamp-2">{{ $op->note }}</p>
                                        @else
                                            <span class="text-gray-400 text-sm italic">No additional notes</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                            <span class="text-3xl text-gray-400">📋</span>
                                        </div>
                                        <span class="text-gray-600 text-xl font-semibold">No Stock Opname Records</span>
                                        <span class="text-gray-500 text-sm mt-2">Audit records will appear here once created</span>
                                        <a href="{{ route('stockopname.create') }}" 
                                           class="mt-4 px-6 py-2 rounded-xl industrial-button hover-lift">
                                            Create First Audit
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

        {{-- Summary Statistics --}}
        @if(count($opnames) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Audits --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl">
                            <span class="text-2xl text-white">📊</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Total Audits</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ count($opnames) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Variance Summary --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <span class="text-2xl text-white">⚖️</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Total Variance</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $opnames->sum('difference') > 0 ? '+' : '' }}{{ number_format($opnames->sum('difference')) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Accuracy Rate --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <span class="text-2xl text-white">🎯</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Accuracy Rate</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ number_format(($opnames->where('difference', 0)->count() / count($opnames)) * 100, 1) }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Audit System: <strong class="text-green-600">Operational</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Records: <strong class="text-gray-700">{{ count($opnames) }} entries</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        // Update any time display elements if they exist
    }
    
    setInterval(updateTime, 1000);
    
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
        
        // Add hover effects for table rows
        const tableRows = document.querySelectorAll('.activity-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(99, 102, 241, 0.05)';
                this.style.transform = 'translateX(5px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endpush
@endsection