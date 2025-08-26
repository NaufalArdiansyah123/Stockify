@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .bg-gradient-dashboard {
        background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
        min-height: 100vh;
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
    
    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        box-shadow: 
            0 10px 20px rgba(99, 102, 241, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(99, 102, 241, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .filter-button {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        box-shadow: 
            0 5px 15px rgba(107, 114, 128, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .action-button {
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .action-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .edit-button {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        box-shadow: 
            0 5px 15px rgba(245, 158, 11, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .delete-button {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        box-shadow: 
            0 5px 15px rgba(239, 68, 68, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .product-count {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.2);
        backdrop-filter: blur(10px);
    }
    
    .filter-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .industrial-input {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(99, 102, 241, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        border-color: rgba(99, 102, 241, 0.5);
        box-shadow: 
            0 0 20px rgba(99, 102, 241, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        outline: none;
        transform: translateY(-1px);
    }
    
    .stock-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .stock-high {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .stock-medium {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .stock-low {
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
                        <span class="text-2xl text-white">📦</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Product Management
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Manage your inventory products</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="product-count px-4 py-2 rounded-xl">
                        <span class="text-sm font-semibold text-indigo-700">
                            Total Products: {{ $items->total() }}
                        </span>
                    </div>
                    <a href="{{ route('products.create') }}" 
                       class="industrial-button px-6 py-3 text-white rounded-xl font-semibold flex items-center space-x-2">
                        <span class="text-lg">➕</span>
                        <span>Add Product</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Enhanced Filter Section --}}
        <div class="filter-container rounded-2xl p-6 hover-lift">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Search & Filter</h3>
                    <p class="text-gray-600 text-sm">Find products quickly with advanced filters</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-blue-400 rounded-full pulse-glow"></div>
                    <span class="text-blue-600 text-sm font-semibold">Filter Active</span>
                </div>
            </div>
            
            <form method="get" id="filterForm" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <span class="flex items-center">
                            <span class="text-lg mr-2">🔍</span>
                            Search Products
                        </span>
                    </label>
                    <input type="text" 
                           name="search" 
                           value="{{ $filters['search'] ?? '' }}" 
                           placeholder="Search by name or code..."
                           class="industrial-input w-full px-4 py-3 rounded-xl">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <span class="flex items-center">
                            <span class="text-lg mr-2">🏷️</span>
                            Category
                        </span>
                    </label>
                    <select name="category_id" class="industrial-input w-full px-4 py-3 rounded-xl">
                        <option value="">All Categories</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" @selected(($filters['category_id'] ?? '')==$c->id)>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <span class="flex items-center">
                            <span class="text-lg mr-2">🏢</span>
                            Supplier
                        </span>
                    </label>
                    <select name="supplier_id" class="industrial-input w-full px-4 py-3 rounded-xl">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers ?? [] as $s)
                            <option value="{{ $s->id }}" @selected(($filters['supplier_id'] ?? '')==$s->id)>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" 
                            class="filter-button w-full px-6 py-3 text-white rounded-xl font-semibold flex items-center justify-center space-x-2 hover-lift transition-all duration-300">
                        <span class="text-lg">🔍</span>
                        <span>Apply Filters</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Enhanced Products Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Products Overview</h2>
                    <p class="text-gray-600 text-sm">Comprehensive product inventory management</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                    <span class="text-green-600 text-sm font-semibold">{{ $items->count() }} Items Loaded</span>
                </div>
            </div>
            
            @if($items->count() > 0)
                <div class="overflow-hidden rounded-xl border border-gray-300">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-100/70">
                                <tr>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">🏷️</span>
                                            Product Code
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">📦</span>
                                            Product Name
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">📂</span>
                                            Category
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">🏢</span>
                                            Supplier
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">📊</span>
                                            Stock
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">🔧</span>
                                            Actions
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($items as $i)
                                <tr class="activity-row">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-indigo-400 rounded-full mr-3 pulse-glow"></div>
                                            <div>
                                                <span class="text-gray-800 font-bold">{{ $i->code }}</span>
                                                <div class="text-gray-500 text-xs">SKU: {{ $i->code }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div>
                                            <span class="text-gray-800 font-semibold text-lg">{{ $i->name }}</span>
                                            @if($i->price_sell)
                                                <div class="text-green-600 text-sm font-medium">
                                                    Rp {{ number_format($i->price_sell, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($i->category)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $i->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($i->supplier)
                                            <span class="text-gray-800 font-medium">{{ $i->supplier->name }}</span>
                                        @else
                                            <span class="text-gray-400">No supplier</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-800 font-bold text-lg">{{ $i->stock }}</span>
                                            @php
                                                $stockClass = 'stock-high';
                                                if($i->stock_minimum && $i->stock <= $i->stock_minimum) {
                                                    $stockClass = 'stock-low';
                                                } elseif($i->stock_minimum && $i->stock <= ($i->stock_minimum * 2)) {
                                                    $stockClass = 'stock-medium';
                                                }
                                            @endphp
                                            <span class="stock-badge {{ $stockClass }}">
                                                @if($i->stock_minimum && $i->stock <= $i->stock_minimum)
                                                    Low
                                                @elseif($i->stock_minimum && $i->stock <= ($i->stock_minimum * 2))
                                                    Medium
                                                @else
                                                    High
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.edit', $i) }}" 
                                               class="action-button edit-button px-3 py-2 text-white rounded-lg font-semibold flex items-center space-x-1">
                                                <span class="text-xs">✏️</span>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('products.destroy', $i) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="action-button delete-button px-3 py-2 text-white rounded-lg font-semibold flex items-center space-x-1"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <span class="text-xs">🗑️</span>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Enhanced Pagination --}}
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} products
                    </div>
                    <div class="pagination-wrapper">
                        {{ $items->links() }}
                    </div>
                </div>
            @else
                <div class="py-16 text-center">
                    <div class="flex flex-col items-center">
                        <div class="industrial-card w-24 h-24 rounded-full flex items-center justify-center mb-6 hover-lift">
                            <span class="text-4xl">📦</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Products Found</h3>
                        <p class="text-gray-600 text-lg mb-6">
                            @if(request()->hasAny(['search', 'category_id', 'supplier_id']))
                                No products match your current filters. Try adjusting your search criteria.
                            @else
                                Start by adding your first product to the inventory.
                            @endif
                        </p>
                        <div class="flex space-x-4">
                            @if(request()->hasAny(['search', 'category_id', 'supplier_id']))
                                <a href="{{ route('products.index') }}" 
                                   class="filter-button px-6 py-3 text-white rounded-xl font-semibold flex items-center space-x-2 hover-lift">
                                    <span class="text-lg">🔄</span>
                                    <span>Clear Filters</span>
                                </a>
                            @endif
                            <a href="{{ route('products.create') }}" 
                               class="industrial-button px-8 py-4 text-white rounded-xl font-semibold flex items-center space-x-3 hover-lift">
                                <span class="text-xl">➕</span>
                                <span>Add Your First Product</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Product System: <strong class="text-green-600">Active</strong></span>
                    <span>Total Items: <strong class="text-gray-700">{{ $items->total() }}</strong></span>
                    <span>Page {{ $items->currentPage() }} of {{ $items->lastPage() }}</span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add real-time search enhancement
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const categorySelect = document.querySelector('select[name="category_id"]');
    const supplierSelect = document.querySelector('select[name="supplier_id"]');
    
    // Auto-submit on select changes
    [categorySelect, supplierSelect].forEach(select => {
        if (select) {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        }
    });
    
    // Add subtle animations on load
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
    
    // Enhanced table row interactions
    const tableRows = document.querySelectorAll('.activity-row');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(99, 102, 241, 0.05)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
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