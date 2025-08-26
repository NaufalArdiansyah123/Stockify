{{-- resources/views/manager/dashboard.blade.php --}}
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
    
    .chart-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
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
    
    .status-warning {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .status-success {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-danger {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .warning-glow {
        animation: warningGlow 2s ease-in-out infinite;
    }
    
    @keyframes warningGlow {
        0%, 100% { 
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
        }
        50% { 
            box-shadow: 0 0 30px rgba(245, 158, 11, 0.6);
        }
    }
    
    .critical-glow {
        animation: criticalGlow 1.5s ease-in-out infinite;
    }
    
    @keyframes criticalGlow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
        }
        50% { 
            box-shadow: 0 0 40px rgba(239, 68, 68, 0.8);
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
                        <span class="text-2xl text-white">📊</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Manager Control Panel
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Inventory Management System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">System Online</span>
                    </div>
                    <span class="text-lg text-gray-800">Welcome, {{ auth()->user()->name }} 👋</span>
                    <div class="text-sm text-gray-500 mt-1">{{ now()->format('l, d F Y') }} - {{ now()->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>

        {{-- Enhanced Statistics Overview --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Products --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl">
                            <span class="text-2xl text-white">📦</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Total Products</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProduct ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Active Items</div>
                        <div class="text-blue-600 text-sm font-semibold">Operational</div>
                    </div>
                </div>
            </div>

            {{-- Low Stock Alert --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border {{ $jumlahStokMenipis > 0 ? 'critical-glow' : '' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            <span class="text-2xl text-white">⚠️</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Low Stock Alert</p>
                            <p class="text-3xl font-bold text-red-600 mt-1">{{ $jumlahStokMenipis ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Critical Items</div>
                        @if($jumlahStokMenipis > 0)
                            <div class="text-red-600 text-sm font-semibold">Action Required</div>
                        @else
                            <div class="text-green-600 text-sm font-semibold">All Good</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Stock In Today --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <span class="text-2xl text-white">📈</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Stock In Today</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalStockMasukHariIni ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Units Received</div>
                        <div class="text-green-600 text-sm font-semibold">↗ Incoming</div>
                    </div>
                </div>
            </div>

            {{-- Stock Out Today --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <span class="text-2xl text-white">📉</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Stock Out Today</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalStockKeluarHariIni ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Units Dispatched</div>
                        <div class="text-orange-600 text-sm font-semibold">↙ Outgoing</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Critical Low Stock Warning Section --}}
        @if($jumlahStokMenipis > 0)
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border critical-glow">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl">⚠️</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Critical Stock Alert</h3>
                            <p class="text-gray-600 text-sm">Products requiring immediate attention</p>
                        </div>
                    </div>
                    <div class="status-badge status-danger">{{ $jumlahStokMenipis }} Items Critical</div>
                </div>
                
                <div class="overflow-hidden rounded-xl border border-red-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-red-50/70">
                                <tr>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Product Code</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Product Name</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Current Stock</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Minimum Stock</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-100">
                                @foreach($productStokMenipis as $product)
                                    {{-- Hapus kondisi berlebihan karena data sudah difilter di controller --}}
                                    <tr class="activity-row bg-white hover:bg-red-50/50">
                                        <td class="py-4 px-6">
                                            <span class="text-gray-800 font-mono font-semibold">{{ $product->code }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-gray-800 font-medium">{{ $product->name }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                @if($product->stock == 0)
                                                    <div class="w-2 h-2 bg-red-600 rounded-full mr-2"></div>
                                                    <span class="text-red-700 font-bold">{{ $product->stock }} {{ $product->unit }}</span>
                                                @elseif($product->stock <= $product->stock_minimum * 0.5)
                                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                                    <span class="text-red-600 font-bold">{{ $product->stock }} {{ $product->unit }}</span>
                                                @else
                                                    <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                                                    <span class="text-orange-600 font-bold">{{ $product->stock }} {{ $product->unit }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-gray-600">{{ $product->stock_minimum }} {{ $product->unit }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($product->stock == 0)
                                                <span class="status-badge status-danger">
                                                    🚨 Out of Stock
                                                </span>
                                            @elseif($product->stock <= $product->stock_minimum * 0.5)
                                                <span class="status-badge status-danger">
                                                    🚨 Critical Low
                                                </span>
                                            @else
                                                <span class="status-badge status-warning">
                                                    ⚠️ Low Stock
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            {{-- Tampilan ketika semua stok sehat --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl">✅</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Stock Status: Healthy</h3>
                            <p class="text-gray-600 text-sm">All products have adequate stock levels</p>
                        </div>
                    </div>
                    <div class="status-badge status-success">All Products OK</div>
                </div>
                
                <div class="mt-4 p-4 bg-green-50/50 rounded-xl border border-green-200">
                    <div class="flex items-center justify-center text-center">
                        <div class="text-green-600">
                            <div class="text-4xl mb-2">📦</div>
                            <p class="font-semibold">No Critical Alerts</p>
                            <p class="text-sm text-gray-600 mt-1">Inventory levels are within safe parameters</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Enhanced Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Stock Movement Chart --}}
            <div class="chart-container rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Stock Movement Analysis</h3>
                        <p class="text-gray-600 text-sm">7-Day Movement Tracking System</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Stock In</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Stock Out</span>
                        </div>
                    </div>
                </div>
                
                <div class="relative" style="height: 350px;">
                    <canvas id="stockChart" width="100%" height="350"></canvas>
                </div>
            </div>

            {{-- Performance Metrics --}}
            <div class="chart-container rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Performance Overview</h3>
                        <p class="text-gray-600 text-sm">System efficiency metrics</p>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full pulse-glow"></div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    {{-- Stock Efficiency --}}
                    <div class="bg-gray-50/70 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-700 font-medium">Stock Efficiency</span>
                            <span class="text-blue-600 font-bold">
                                {{ ($totalStockMasukHariIni ?? 0) > 0 ? number_format(((($totalStockMasukHariIni ?? 0) - ($totalStockKeluarHariIni ?? 0)) / ($totalStockMasukHariIni ?? 0)) * 100, 1) : 0 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" 
                                 style="width: {{ ($totalStockMasukHariIni ?? 0) > 0 ? min(100, ((($totalStockMasukHariIni ?? 0) - ($totalStockKeluarHariIni ?? 0)) / ($totalStockMasukHariIni ?? 0)) * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    {{-- Stock Health --}}
                    <div class="bg-gray-50/70 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-700 font-medium">Stock Health</span>
                            <span class="text-green-600 font-bold">
                                {{ ($totalProduct ?? 0) > 0 ? number_format((($totalProduct - $jumlahStokMenipis) / $totalProduct) * 100, 1) : 100 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full transition-all duration-300" 
                                 style="width: {{ ($totalProduct ?? 0) > 0 ? (($totalProduct - $jumlahStokMenipis) / $totalProduct) * 100 : 100 }}%"></div>
                        </div>
                    </div>

                    {{-- Today's Activity --}}
                    <div class="bg-gray-50/70 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-700 font-medium">Today's Activity</span>
                            <span class="text-purple-600 font-bold">
                                {{ ($totalStockMasukHariIni ?? 0) + ($totalStockKeluarHariIni ?? 0) }} Units
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full transition-all duration-300 pulse-glow" 
                                 style="width: {{ min(100, (($totalStockMasukHariIni ?? 0) + ($totalStockKeluarHariIni ?? 0)) / 10) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Today's Transactions --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Stock In Today --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl">📈</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Today's Incoming Stock</h3>
                            <p class="text-gray-600 text-sm">Total: {{ $totalStockMasukHariIni ?? 0 }} units received</p>
                        </div>
                    </div>
                    <div class="status-badge status-success">{{ ($stockMasukHariIni ?? collect())->count() }} Transactions</div>
                </div>
                
                <div class="max-h-80 overflow-y-auto space-y-3">
                    @forelse($stockMasukHariIni ?? [] as $movement)
                    <div class="bg-green-50/50 border border-green-200 rounded-xl p-4 activity-row">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-gray-800 font-semibold">{{ $movement->product->name ?? 'N/A' }}</span>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">Code: {{ $movement->product->code ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $movement->description ?? 'Standard stock entry' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-600 font-bold text-lg">+{{ $movement->quantity }} {{ $movement->product->unit ?? 'units' }}</p>
                                <p class="text-xs text-gray-500">{{ $movement->created_at->format('H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl text-gray-400">📦</span>
                        </div>
                        <p class="text-gray-600">No incoming stock today</p>
                        <p class="text-gray-500 text-sm">Stock entries will appear here</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Stock Out Today --}}
            <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl">📉</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Today's Outgoing Stock</h3>
                            <p class="text-gray-600 text-sm">Total: {{ $totalStockKeluarHariIni ?? 0 }} units dispatched</p>
                        </div>
                    </div>
                    <div class="status-badge status-warning">{{ ($stockKeluarHariIni ?? collect())->count() }} Transactions</div>
                </div>
                
                <div class="max-h-80 overflow-y-auto space-y-3">
                    @forelse($stockKeluarHariIni ?? [] as $movement)
                    <div class="bg-orange-50/50 border border-orange-200 rounded-xl p-4 activity-row">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span class="text-gray-800 font-semibold">{{ $movement->product->name ?? 'N/A' }}</span>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">Code: {{ $movement->product->code ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $movement->description ?? 'Standard stock dispatch' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-orange-600 font-bold text-lg">-{{ $movement->quantity }} {{ $movement->product->unit ?? 'units' }}</p>
                                <p class="text-xs text-gray-500">{{ $movement->created_at->format('H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl text-gray-400">📋</span>
                        </div>
                        <p class="text-gray-600">No outgoing stock today</p>
                        <p class="text-gray-500 text-sm">Stock dispatches will appear here</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>System Status: <strong class="text-green-600">Operational</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Manager Panel: <strong class="text-gray-700">Active</strong></span>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grafikData = @json($grafikData ?? []);
    
    // Enhanced Chart Configuration
    Chart.defaults.color = '#4b5563';
    Chart.defaults.backgroundColor = 'rgba(99, 102, 241, 0.8)';
    
    // Stock Movement Chart
    const ctx = document.getElementById('stockChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: grafikData.map(item => item.tanggal || 'No Date'),
            datasets: [
                {
                    label: 'Stock In',
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    data: grafikData.map(item => item.masuk || 0)
                },
                {
                    label: 'Stock Out',
                    backgroundColor: 'rgba(249, 115, 22, 0.8)',
                    borderColor: 'rgba(249, 115, 22, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    data: grafikData.map(item => item.keluar || 0)
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        color: '#4b5563',
                        font: {
                            family: 'Inter',
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#374151',
                    borderColor: 'rgba(156, 163, 175, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        title: function(context) {
                            return 'Date: ' + context[0].label;
                        },
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y + ' units';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(156, 163, 175, 0.2)',
                        borderColor: 'rgba(156, 163, 175, 0.4)'
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.2)',
                        borderColor: 'rgba(156, 163, 175, 0.4)'
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    }
                }
            },
            elements: {
                bar: {
                    borderSkipped: 'bottom'
                }
            }
        }
    });

    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID');
        // Update any time display elements if they exist
    }
    
    setInterval(updateTime, 1000);
    
    // Add entrance animations
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

    // Enhanced interactive notifications for low stock
    const lowStockCount = {{ $jumlahStokMenipis ?? 0 }};
    if (lowStockCount > 0) {
        // Add blinking effect to critical items
        const criticalElements = document.querySelectorAll('.critical-glow');
        criticalElements.forEach(el => {
            el.style.animation = 'criticalGlow 1.5s ease-in-out infinite';
        });
        
        // Console notification for development
        console.log(`🚨 Manager Alert: ${lowStockCount} products require immediate attention!`);
    }

    // Enhanced table row interactions
    const activityRows = document.querySelectorAll('.activity-row');
    activityRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(99, 102, 241, 0.05)';
            this.style.transform = 'translateX(5px)';
            this.style.borderRadius = '8px';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'translateX(0)';
        });
    });

    // System status indicator
    const statusIndicators = document.querySelectorAll('.pulse-glow');
    statusIndicators.forEach(indicator => {
        setInterval(() => {
            indicator.style.opacity = indicator.style.opacity === '0.3' ? '1' : '0.3';
        }, 1500);
    });

    // Performance monitoring
    const performanceData = {
        totalProducts: {{ $totalProduct ?? 0 }},
        lowStock: {{ $jumlahStokMenipis ?? 0 }},
        todayIn: {{ $totalStockMasukHariIni ?? 0 }},
        todayOut: {{ $totalStockKeluarHariIni ?? 0 }}
    };
    
    // Calculate efficiency ratio
    const efficiency = performanceData.todayIn > 0 ? 
        ((performanceData.todayIn - performanceData.todayOut) / performanceData.todayIn * 100).toFixed(1) : 0;
    
    console.log('📊 Manager Dashboard Metrics:', performanceData);
    console.log(`⚡ Today's Stock Efficiency: ${efficiency}%`);

    // Progressive bar animations
    const progressBars = document.querySelectorAll('.bg-blue-500, .bg-green-500, .bg-purple-500');
    progressBars.forEach((bar, index) => {
        setTimeout(() => {
            const currentWidth = bar.style.width;
            bar.style.width = '0%';
            bar.style.transition = 'width 1.5s cubic-bezier(0.4, 0.0, 0.2, 1)';
            
            setTimeout(() => {
                bar.style.width = currentWidth;
            }, 100);
        }, index * 200);
    });
});
</script>
@endpush