@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .bg-gradient-industrial {
        background: linear-gradient(135deg, #f1f5f9 0%, #dbeafe 50%, #e0e7ff 100%);
        min-height: 100vh;
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.05);
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
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
    
    .product-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .product-image-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }
    
    .product-image-container:hover::before {
        opacity: 1;
    }
    
    .product-image {
        transition: transform 0.5s ease;
        position: relative;
        z-index: 0;
    }
    
    .product-image:hover {
        transform: scale(1.05);
    }
    
    .info-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
    }
    
    .action-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .action-btn:hover::before {
        left: 100%;
    }
    
    .status-indicator {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 2px solid;
    }
    
    .status-available {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .status-low {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border-color: rgba(245, 158, 11, 0.3);
    }
    
    .status-out {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        space-x: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }
    
    .breadcrumb a {
        color: #6366f1;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb a:hover {
        color: #4f46e5;
    }
    
    .data-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .data-item {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .data-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .data-item:hover::before {
        transform: translateX(0);
    }
    
    .data-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="bg-gradient-industrial min-h-screen industrial-grid">
    <div class="container mx-auto p-6 space-y-8">
    
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">📋</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Product Details
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Inventory Management System</p>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" 
                           class="action-btn px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-semibold shadow-lg transition duration-300 flex items-center space-x-2">
                            <span>←</span>
                            <span>Back to Products</span>
                </a>
            </div>
        </div>

        {{-- Product Image Section - Full Width at Top --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="text-blue-500 mr-3">🖼️</span>
                Product Visual
            </h3>
            
            <div class="flex justify-center">
                <div class="product-image-container max-w-2xl w-full">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="product-image w-full h-96 lg:h-[500px] object-cover">
                    @else
                        <div class="w-full h-96 lg:h-[500px] flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl">
                            <div class="text-center">
                                <div class="text-8xl text-gray-400 mb-6">📦</div>
                                <p class="text-gray-500 font-medium text-lg">No Image Available</p>
                                <p class="text-gray-400 text-sm mt-2">Product image will appear here</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Product Information Section - Full Width Below --}}
        <div class="space-y-6">
                
                {{-- Basic Information --}}
                <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="text-indigo-500 mr-3">ℹ️</span>
                        Product Information
                    </h3>
                    
                    <div class="space-y-6">
                        {{-- Product Name --}}
                        <div>
                            <h2 class="text-4xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                            <div class="flex items-center space-x-3">
                                {{-- Category Badge --}}
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-700 border border-gray-300">
                                    <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                                
                                {{-- Stock Status --}}
                                @if($product->stock > 20)
                                    <span class="status-indicator status-available">
                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                        In Stock
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="status-indicator status-low">
                                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></span>
                                        Low Stock
                                    </span>
                                @else
                                    <span class="status-indicator status-out">
                                        <span class="w-2 h-2 bg-red-400 rounded-full mr-2 animate-pulse"></span>
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
                            <p class="text-yellow-700 text-sm font-semibold mb-2">PRICE SELL</p>
                            <p class="text-5xl font-extrabold text-yellow-600">
                                Rp {{ number_format($product->price_sell, 0, ',', '.') }}
                            </p>
                            <p class="text-yellow-600 text-sm mt-2">Price per unit</p>
                        </div>
                    </div>
                </div>

                {{-- Detailed Specifications --}}
                <div class="industrial-card rounded-2xl p-6 hover-lift">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="text-purple-500 mr-3">📊</span>
                        Product Specifications
                    </h3>
                    
                    <div class="data-grid">
                        <div class="data-item">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-blue-600">📦</span>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wide">Current Stock</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $product->stock }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-600">
                                Available units in inventory
                            </div>
                        </div>

                        <div class="data-item">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-green-600">🏷️</span>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wide">Product Code</p>
                                    <p class="text-2xl font-bold text-gray-800">#{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-600">
                                Unique identifier
                            </div>
                        </div>

                        <div class="data-item">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-purple-600">📈</span>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wide">Stock Value</p>
                                    <p class="text-xl font-bold text-gray-800">
                                        Rp {{ number_format($product->stock * $product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-600">
                                Total inventory value
                            </div>
                        </div>

                        <div class="data-item">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-orange-600">📅</span>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wide">Last Updated</p>
                                    <p class="text-lg font-bold text-gray-800">
                                        {{ $product->updated_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ $product->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="industrial-card rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-red-500 mr-2">⚡</span>
                        Quick Actions
                    </h3>
                    
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('products.index') }}" 
                           class="action-btn px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-semibold shadow-lg transition duration-300 flex items-center space-x-2">
                            <span>←</span>
                            <span>Back to Products</span>
                        </a>
                        
                        <a href="{{ route('products.edit', $product->id) }}" 
                           class="action-btn px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow-lg transition duration-300 flex items-center space-x-2">
                            <span>✏️</span>
                            <span>Edit Product</span>
                        </a>
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-btn px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-semibold shadow-lg transition duration-300 flex items-center space-x-2">
                                <span>🗑️</span>
                                <span>Delete Product</span>
                            </button>
                        </form>
                    </div>
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
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add loading animation
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.hover-lift');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });
    });

    // Add real-time clock update for footer
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        // Update time display if element exists
        const timeElement = document.querySelector('[data-time]');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    setInterval(updateTime, 1000);

    // Add click animation to action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple-effect');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
</script>

<style>
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>

@endsection