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
        transform: translateY(-2px) scale(1.01);
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
    
    .industrial-input {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(148, 163, 184, 0.3);
        border-radius: 12px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        color: #374151;
    }
    
    .industrial-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1), 0 0 20px rgba(99, 102, 241, 0.2);
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-1px);
    }
    
    .industrial-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: 'Inter', sans-serif;
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 14px 28px;
        color: white;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        box-shadow: 
            0 10px 20px rgba(99, 102, 241, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(99, 102, 241, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .industrial-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .industrial-button:hover::before {
        left: 100%;
    }
    
    .form-section {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(15px);
        margin-bottom: 16px;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid rgba(99, 102, 241, 0.2);
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        space: 2px;
        margin-bottom: 24px;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .breadcrumb-item {
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .breadcrumb-separator {
        margin: 0 8px;
        color: #9ca3af;
    }
    
    .breadcrumb-current {
        color: #6366f1;
        font-weight: 600;
    }
    
    .image-upload-area {
        border: 2px dashed rgba(99, 102, 241, 0.3);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        background: rgba(99, 102, 241, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .image-upload-area:hover {
        border-color: rgba(99, 102, 241, 0.6);
        background: rgba(99, 102, 241, 0.1);
        transform: translateY(-2px);
    }
    
    .image-upload-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 max-w-6xl mx-auto">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">✏️</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Edit Product
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Modify Product Information - Industrial Control System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700">
                        <div class="w-2 h-2 bg-orange-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Edit Mode</span>
                    </div>
                    <span class="text-lg text-gray-800">Product ID: {{ $product->code }}</span>
                </div>
            </div>
        </div>

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Dashboard</span>
            <span class="breadcrumb-separator">→</span>
            <span class="breadcrumb-item">Products</span>
            <span class="breadcrumb-separator">→</span>
            <span class="breadcrumb-current">Edit Product</span>
        </nav>

        {{-- Main Form --}}
        <form method="post" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf 
            @method('put')
            
            <div class="grid lg:grid-cols-2 gap-6">
                {{-- Left Section - Basic Information --}}
                <div class="form-section hover-lift">
                    <div class="section-title">
                        <div class="section-icon">
                            <span class="text-white text-lg">📋</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Basic Information</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="industrial-label">Product Code</label>
                            <input 
                                name="code" 
                                class="industrial-input" 
                                value="{{ $product->code }}" 
                                required 
                                placeholder="Enter product code"
                            />
                        </div>
                        
                        <div>
                            <label class="industrial-label">Product Name</label>
                            <input 
                                name="name" 
                                class="industrial-input" 
                                value="{{ $product->name }}" 
                                required 
                                placeholder="Enter product name"
                            />
                        </div>
                        
                        <div>
                            <label class="industrial-label">Category</label>
                            <select name="category_id" class="industrial-input">
                                <option value="">Select Category</option>
                                @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected($product->category_id == $c->id)>
                                    {{ $c->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="industrial-label">Supplier</label>
                            <select name="supplier_id" class="industrial-input">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $s)
                                <option value="{{ $s->id }}" @selected($product->supplier_id == $s->id)>
                                    {{ $s->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Right Section - Pricing & Inventory --}}
                <div class="form-section hover-lift">
                    <div class="section-title">
                        <div class="section-icon">
                            <span class="text-white text-lg">💰</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Pricing & Inventory</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="industrial-label">Purchase Price</label>
                            <input 
                                name="price_buy" 
                                type="number" 
                                class="industrial-input" 
                                value="{{ $product->price_buy }}" 
                                placeholder="0.00"
                                step="0.01"
                            />
                        </div>
                        
                        <div>
                            <label class="industrial-label">Selling Price</label>
                            <input 
                                name="price_sell" 
                                type="number" 
                                class="industrial-input" 
                                value="{{ $product->price_sell }}" 
                                placeholder="0.00"
                                step="0.01"
                            />
                        </div>
                        
                        <div>
                            <label class="industrial-label">Minimum Stock</label>
                            <input 
                                name="stock_minimum" 
                                type="number" 
                                class="industrial-input" 
                                value="{{ $product->stock_minimum }}" 
                                placeholder="0"
                            />
                        </div>
                        
                        <div>
                            <label class="industrial-label">Product Attributes (JSON)</label>
                            <textarea 
                                name="attributes" 
                                class="industrial-input" 
                                rows="4"
                                placeholder='{"color": "red", "size": "large"}'
                            >{{ json_encode($product->attributes) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Upload Section --}}
            <div class="form-section hover-lift">
                <div class="section-title">
                    <div class="section-icon">
                        <span class="text-white text-lg">🖼️</span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Product Image</h2>
                </div>
                
                <div class="image-upload-area">
                    <div class="image-upload-icon">
                        <span class="text-white text-xl">📸</span>
                    </div>
                    <p class="text-gray-700 font-semibold mb-2">Upload Product Image</p>
                    <p class="text-gray-500 text-sm mb-4">Choose a new image to replace the current one</p>
                    <input 
                        type="file" 
                        name="image" 
                        class="industrial-input" 
                        accept="image/*"
                        style="background: rgba(255, 255, 255, 0.8);"
                    />
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                    ← Back to Products
                </a>
                
                <div class="space-x-4">
                    <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit" class="industrial-button">
                        <span class="relative z-10">💾 Update Product</span>
                    </button>
                </div>
            </div>
        </form>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4 mt-8">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Edit Session: <strong class="text-orange-600">Active</strong></span>
                    <span>Last Modified: <strong class="text-gray-700">{{ $product->updated_at->format('d M Y H:i') }}</strong></span>
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
    // Add loading animation on form submission
    document.querySelector('form').addEventListener('submit', function() {
        const button = document.querySelector('.industrial-button');
        button.innerHTML = '<span class="relative z-10">⏳ Updating...</span>';
        button.disabled = true;
    });

    // Add subtle animations on load
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.form-section');
        sections.forEach((section, index) => {
            setTimeout(() => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 100);
            }, index * 150);
        });
    });

    // Enhanced input focus effects
    document.querySelectorAll('.industrial-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });

    // Image upload preview functionality
    const imageInput = document.querySelector('input[name="image"]');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const uploadArea = document.querySelector('.image-upload-area');
                uploadArea.style.borderColor = '#10b981';
                uploadArea.style.backgroundColor = 'rgba(16, 185, 129, 0.1)';
                
                const icon = uploadArea.querySelector('.image-upload-icon span');
                icon.textContent = '✅';
                
                const text = uploadArea.querySelector('p');
                text.textContent = `Selected: ${file.name}`;
            }
        });
    }
</script>
@endsection