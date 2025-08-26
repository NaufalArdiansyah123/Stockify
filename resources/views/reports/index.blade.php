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

    .filter-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 
            inset 0 1px 0 rgba(255, 255, 255, 0.3),
            0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .industrial-input {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(156, 163, 175, 0.3);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .industrial-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        outline: none;
    }

    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 4px 15px rgba(99, 102, 241, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 8px 25px rgba(99, 102, 241, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .table-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(5px);
        transition: all 0.3s ease;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        backdrop-filter: blur(10px);
        border-bottom: 2px solid rgba(99, 102, 241, 0.2);
    }

    .stock-positive {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
    }

    .stock-negative {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
    }

    .stock-zero {
        background: rgba(156, 163, 175, 0.1);
        color: #6b7280;
        border: 1px solid rgba(156, 163, 175, 0.2);
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">📋</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Stock & Transaction Report
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Comprehensive Inventory Analysis System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700">
                        <div class="w-2 h-2 bg-blue-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Report Generated</span>
                    </div>
                    <span class="text-lg text-gray-800">{{ now()->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Enhanced Filter Section --}}
        <div class="filter-container rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Date Range Filter</h2>
                    <p class="text-gray-600 text-sm">Select reporting period for analysis</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-semibold">Active Filter</span>
                </div>
            </div>
            
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                    <input type="date" 
                           name="start_date" 
                           value="{{ $start }}" 
                           class="industrial-input px-4 py-3 rounded-xl text-gray-700 font-medium">
                </div>
                
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">End Date</label>
                    <input type="date" 
                           name="end_date" 
                           value="{{ $end }}" 
                           class="industrial-input px-4 py-3 rounded-xl text-gray-700 font-medium">
                </div>
                
                <div class="flex flex-col justify-end">
                    <button type="submit" 
                            class="industrial-button text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2">
                        <span>🔄</span>
                        <span>Apply Filter</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Enhanced Stock Summary Section --}}
        <div class="table-container rounded-2xl overflow-hidden hover-lift industrial-border">
            <div class="p-6 border-b border-gray-200/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-3">
                            <span class="text-2xl">📦</span>
                            <span>Stock Summary</span>
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Current inventory levels and movements</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-400 rounded-full pulse-glow"></div>
                        <span class="text-blue-600 text-sm font-semibold">{{ count($products) }} Items</span>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Product Code
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Product Name
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Supplier
                            </th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                ↗ In
                            </th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                ↙ Out
                            </th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Balance
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/50">
                        @foreach($products as $p)
                        @php
                            $balance = ($p->stock_in ?? 0) - ($p->stock_out ?? 0);
                        @endphp
                        <tr class="table-row">
                            <td class="py-4 px-6">
                                <span class="text-gray-800 font-bold font-mono">{{ $p->code }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ substr($p->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-gray-800 font-semibold">{{ $p->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                                    {{ $p->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-gray-700 font-medium">{{ $p->supplier->name ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="status-in px-3 py-1 rounded-lg font-bold">
                                    +{{ $p->stock_in ?? 0 }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="status-out px-3 py-1 rounded-lg font-bold">
                                    -{{ $p->stock_out ?? 0 }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="@if($balance > 0) stock-positive @elseif($balance < 0) stock-negative @else stock-zero @endif text-lg">
                                    {{ $balance }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Enhanced Transaction History Section --}}
        <div class="table-container rounded-2xl overflow-hidden hover-lift industrial-border">
            <div class="p-6 border-b border-gray-200/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-3">
                            <span class="text-2xl">📊</span>
                            <span>Transaction History</span>
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Detailed movement tracking and audit trail</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-green-600 text-sm font-semibold">Live Tracking</span>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Timestamp
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Product
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Transaction Type
                            </th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                User
                            </th>
                            <th class="py-4 px-6 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Notes
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/50">
                        @forelse($transactions as $t)
                        <tr class="table-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                    <div>
                                        <div class="text-gray-800 font-semibold">
                                            {{ \Carbon\Carbon::parse($t->happened_at)->format('d M Y') }}
                                        </div>
                                        <div class="text-gray-500 text-sm">
                                            {{ \Carbon\Carbon::parse($t->happened_at)->format('H:i:s') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ substr($t->product->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-gray-800 font-semibold">{{ $t->product->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="status-badge {{ $t->type == 'IN' ? 'status-in' : 'status-out' }}">
                                    {{ $t->type == 'IN' ? '↗ STOCK IN' : '↙ STOCK OUT' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="text-gray-800 font-bold text-lg">{{ $t->quantity }}</span>
                                <span class="text-gray-500 text-sm ml-1">units</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($t->user->name ?? 'S', 0, 1) }}</span>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ $t->user->name ?? 'System' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-gray-600 italic">{{ $t->note ?? 'No additional notes' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                        <span class="text-3xl text-gray-400">📋</span>
                                    </div>
                                    <span class="text-gray-600 text-xl font-semibold">No transactions found</span>
                                    <span class="text-gray-500 text-sm mt-1">Transactions will appear here when recorded</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Report Status: <strong class="text-green-600">Generated</strong></span>
                    <span>Export Options: <strong class="text-blue-600">PDF, Excel</strong></span>
                    <span>Last Updated: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

        // Add filter animation
        const filterInputs = document.querySelectorAll('.industrial-input');
        filterInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Add table row hover effects
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 15px rgba(99, 102, 241, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endpush