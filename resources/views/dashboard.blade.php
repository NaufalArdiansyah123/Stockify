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
                            Control Dashboard
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Inventory Management System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">System Online</span>
                    </div>
                    <span class="text-lg text-gray-800">Welcome, {{ Auth::user()->name }} 👋</span>
                </div>
            </div>
        </div>

        {{-- Enhanced Statistics Cards --}}
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
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Product::count() }}</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-500">Active Items</div>
                <div class="text-green-600 text-sm font-semibold">+12% this month</div>
            </div>
        </div>
    </div>

    {{-- Stock In --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <span class="text-2xl text-white">📈</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm uppercase tracking-wide">Stock In This Month</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\StockMovement::where('type','IN')->whereMonth('happened_at',now()->month)->sum('quantity') }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-500">Units Received</div>
                <div class="text-green-600 text-sm font-semibold">Incoming Flow</div>
            </div>
        </div>
    </div>

    {{-- Stock Out --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <span class="text-2xl text-white">📉</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm uppercase tracking-wide">Stock Out This Month</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\StockMovement::where('type','OUT')->whereMonth('happened_at',now()->month)->sum('quantity') }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-500">Units Dispatched</div>
                <div class="text-red-600 text-sm font-semibold">Outgoing Flow</div>
            </div>
        </div>
    </div>

    {{-- Total Stock --}}
    <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="metric-icon p-4 rounded-2xl" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <span class="text-2xl text-white">📊</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm uppercase tracking-wide">Total Stock</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\Product::sum('stock') }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-500">Units Available</div>
                <div class="text-blue-600 text-sm font-semibold">Current Inventory</div>
            </div>
        </div>
    </div>
</div>

        {{-- Enhanced Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Stock Movement Chart --}}
            <div class="chart-container rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Stock Flow Analysis</h3>
                        <p class="text-gray-600 text-sm">12-Month Movement Tracking</p>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    </div>
                </div>
                <div class="relative">
                    <canvas id="stockChart" height="250"></canvas>
                </div>
            </div>

            {{-- Stock Opname Chart --}}
            <div class="chart-container rounded-2xl p-6 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Stock Opname Variance</h3>
                        <p class="text-gray-600 text-sm">Inventory Audit Results</p>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-teal-500 rounded-full pulse-glow"></div>
                    </div>
                </div>
                <div class="relative">
                    <canvas id="opnameChart" height="250"></canvas>
                </div>
            </div>
        </div>

        {{-- Enhanced Activity Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Recent Stock Activities</h2>
                    <p class="text-gray-600 text-sm">Real-time inventory movements</p>
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
                                <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recent as $m)
                            <tr class="activity-row">
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                                        <span class="text-gray-700 font-medium">{{ $m->happened_at->format('d M Y') }}</span>
                                        <span class="text-gray-500 text-sm ml-2">{{ $m->happened_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-gray-800 font-medium">{{ $m->product->name ?? '-' }}</span>
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
                                    <span class="text-gray-600">{{ $m->note ?? 'No additional notes' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                            <span class="text-2xl text-gray-400">📊</span>
                                        </div>
                                        <span class="text-gray-600 text-lg">No recent activities</span>
                                        <span class="text-gray-500 text-sm">Stock movements will appear here</span>
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
                    <span>System Status: <strong class="text-green-600">Operational</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Version: <strong class="text-gray-700">2.0.1</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024 | <a href="#">Credit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json($chartData);
    const opnameData = @json($opnameData);

    // Enhanced Chart Configuration
    Chart.defaults.color = '#4b5563';
    Chart.defaults.backgroundColor = 'rgba(99, 102, 241, 0.8)';
    
    // Label bulan
    const labels = chartData.map(item => "Month " + item.month);
    
    // Data stok masuk/keluar
    const dataIn = chartData.map(item => item.total_in);
    const dataOut = chartData.map(item => item.total_out);
    
    // Data opname
    const dataDiff = opnameData.map(item => item.total_diff);

    // Enhanced Stock Movement Chart
    new Chart(document.getElementById('stockChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Stock In',
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    data: dataIn
                },
                {
                    label: 'Stock Out',
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    data: dataOut
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
                        color: '#4b5563'
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
                        color: '#6b7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.2)',
                        borderColor: 'rgba(156, 163, 175, 0.4)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });

    // Enhanced Opname Chart
    new Chart(document.getElementById('opnameChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Stock Variance',
                backgroundColor: 'rgba(6, 182, 212, 0.2)',
                borderColor: 'rgba(6, 182, 212, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(6, 182, 212, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                data: dataDiff
            }]
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
                        color: '#4b5563'
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)',
                        borderColor: 'rgba(148, 163, 184, 0.3)'
                    },
                    ticks: {
                        color: '#94a3b8'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)',
                        borderColor: 'rgba(148, 163, 184, 0.3)'
                    },
                    ticks: {
                        color: '#94a3b8'
                    }
                }
            }
        }
    });

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
    });
</script>
@endpush