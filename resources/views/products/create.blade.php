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
        background: linear-gradient(90deg, transparent, #10b981, transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .metric-icon {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 
            0 10px 20px rgba(16, 185, 129, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        box-shadow: 
            0 10px 20px rgba(16, 185, 129, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(16, 185, 129, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .back-button {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        box-shadow: 
            0 5px 15px rgba(107, 114, 128, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .industrial-input {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        border-color: rgba(16, 185, 129, 0.5);
        box-shadow: 
            0 0 20px rgba(16, 185, 129, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        outline: none;
        transform: translateY(-1px);
    }
    
    .form-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .pulse-glow {
        animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }
        50% { 
            box-shadow: 0 0 40px rgba(16, 185, 129, 0.6);
        }
    }
    
    .form-section {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .file-upload {
        border: 2px dashed rgba(16, 185, 129, 0.3);
        background: rgba(16, 185, 129, 0.05);
        transition: all 0.3s ease;
    }
    
    .file-upload:hover {
        border-color: rgba(16, 185, 129, 0.5);
        background: rgba(16, 185, 129, 0.1);
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">➕</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Create New Product
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Add a new product to your inventory system</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                    <span class="text-green-600 text-sm font-semibold">Ready to Create</span>
                </div>
            </div>
        </div>

        {{-- Enhanced Form Section --}}
        <div class="max-w-6xl mx-auto">
            <div class="form-container rounded-2xl p-8 hover-lift industrial-border">
                <div class="text-center mb-8">
                    <div class="industrial-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 hover-lift">
                        <span class="text-3xl">📦</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Product Information</h2>
                    <p class="text-gray-600">Fill in the details for your new product</p>
                </div>

                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        {{-- Left Column - Basic Information --}}
                        <div class="form-section rounded-2xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <span class="text-xl">ℹ️</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Basic Information</h3>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">🏷️</span>
                                            Product Code *
                                        </span>
                                    </label>
                                    <input type="text" 
                                           name="code" 
                                           placeholder="e.g., PRD-001, SKU-123"
                                           class="industrial-input w-full px-4 py-3 rounded-xl"
                                           required>
                                    <div class="text-xs text-gray-500">Unique identifier for the product</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">📦</span>
                                            Product Name *
                                        </span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           placeholder="Enter descriptive product name"
                                           class="industrial-input w-full px-4 py-3 rounded-xl"
                                           required>
                                    <div class="text-xs text-gray-500">Clear, descriptive name for the product</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">📂</span>
                                            Category
                                        </span>
                                    </label>
                                    <select name="category_id" class="industrial-input w-full px-4 py-3 rounded-xl">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-xs text-gray-500">Organize products by category</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">🏢</span>
                                            Supplier
                                        </span>
                                    </label>
                                    <select name="supplier_id" class="industrial-input w-full px-4 py-3 rounded-xl">
                                        <option value="">Select Supplier</option>
                                        @foreach($suppliers as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-xs text-gray-500">Choose the product supplier</div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column - Pricing & Stock --}}
                        <div class="form-section rounded-2xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <span class="text-xl">💰</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Pricing & Stock</h3>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">💸</span>
                                            Purchase Price
                                        </span>
                                    </label>
                                    <input type="number" 
                                           name="price_buy" 
                                           placeholder="0"
                                           step="0.01"
                                           min="0"
                                           class="industrial-input w-full px-4 py-3 rounded-xl"
                                           value="{{ old('price_buy') }}"/>
                                    <div class="text-xs text-gray-500">Cost per unit when purchasing</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">💰</span>
                                            Selling Price
                                        </span>
                                    </label>
                                    <input type="number" 
                                           name="price_sell" 
                                           placeholder="0"
                                           step="0.01"
                                           min="0"
                                           class="industrial-input w-full px-4 py-3 rounded-xl">
                                    <div class="text-xs text-gray-500">Retail price for customers</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">⚠️</span>
                                            Minimum Stock Level
                                        </span>
                                    </label>
                                    <input type="number" 
                                           name="stock_minimum" 
                                           placeholder="0"
                                           min="0"
                                           class="industrial-input w-full px-4 py-3 rounded-xl">
                                    <div class="text-xs text-gray-500">Alert when stock falls below this level</div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                        <span class="flex items-center">
                                            <span class="text-lg mr-2">🔧</span>
                                            Product Attributes
                                        </span>
                                    </label>
                                    <textarea name="attributes" 
                                              placeholder='{"color":"black","size":"medium","weight":"1kg"}'
                                              rows="4"
                                              class="industrial-input w-full px-4 py-3 rounded-xl resize-none"></textarea>
                                    <div class="text-xs text-gray-500">Additional properties in JSON format</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Image Upload Section --}}
                    <div class="form-section rounded-2xl p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-xl">🖼️</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Product Image</h3>
                        </div>
                        
                        <div class="file-upload rounded-xl p-8 text-center">
                            <div class="mb-4">
                                <span class="text-4xl">📸</span>
                            </div>
                            <input type="file" 
                                   name="image" 
                                   accept="image/*"
                                   class="industrial-input w-full px-4 py-3 rounded-xl">
                            <div class="mt-4 text-sm text-gray-600">
                                <p>Upload a product image (JPG, PNG, GIF)</p>
                                <p class="text-xs text-gray-500 mt-1">Recommended size: 800x600 pixels, Max: 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex space-x-4 pt-6">
                        <button type="submit" 
                                class="industrial-button flex-1 px-6 py-4 text-white rounded-xl font-bold text-lg flex items-center justify-center space-x-3">
                            <span class="text-xl">💾</span>
                            <span>Save Product</span>
                        </button>
                        
                        <a href="{{ route('products.index') }}" 
                           class="back-button px-6 py-4 text-white rounded-xl font-bold text-lg flex items-center justify-center space-x-3 hover-lift transition-all duration-300">
                            <span class="text-xl">↩️</span>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tips Section --}}
        <div class="max-w-6xl mx-auto">
            <div class="industrial-card rounded-2xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-xl">💡</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Product Creation Tips</h3>
                </div>
                <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-600">
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Use unique, memorable product codes for easy identification</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Set realistic minimum stock levels to avoid stockouts</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Include detailed product names for better searchability</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Upload high-quality images to improve product visibility</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Use JSON attributes for additional product specifications</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-500 mt-1">•</span>
                            <span>Assign categories and suppliers for better organization</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Form Status: <strong class="text-green-600">Ready</strong></span>
                    <span>Categories: <strong class="text-gray-700">{{ count($categories) }}</strong></span>
                    <span>Suppliers: <strong class="text-gray-700">{{ count($suppliers) }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add real-time form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const codeInput = document.querySelector('input[name="code"]');
    const nameInput = document.querySelector('input[name="name"]');
    const priceBuyInput = document.querySelector('input[name="price_buy"]');
    const priceSellInput = document.querySelector('input[name="price_sell"]');
    const imageInput = document.querySelector('input[name="image"]');
    
    // Auto-generate code suggestion based on name
    nameInput.addEventListener('input', function() {
        if (!codeInput.value && this.value) {
            const suggestion = 'PRD-' + this.value.substring(0, 3).toUpperCase() + '-' + 
                              Math.random().toString(36).substr(2, 3).toUpperCase();
            codeInput.placeholder = `Suggestion: ${suggestion}`;
        }
    });
    
    // Price validation
    priceSellInput.addEventListener('input', function() {
        const buyPrice = parseFloat(priceBuyInput.value) || 0;
        const sellPrice = parseFloat(this.value) || 0;
        
        if (buyPrice > 0 && sellPrice > 0 && sellPrice <= buyPrice) {
            this.style.borderColor = 'rgba(239, 68, 68, 0.5)';
            showTooltip(this, 'Selling price should be higher than purchase price');
        } else {
            this.style.borderColor = 'rgba(16, 185, 129, 0.2)';
            hideTooltip(this);
        }
    });
    
    // Image preview
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview
                const existingPreview = document.querySelector('.image-preview');
                if (existingPreview) existingPreview.remove();
                
                // Create new preview
                const preview = document.createElement('div');
                preview.className = 'image-preview mt-4 text-center';
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="mx-auto rounded-lg shadow-lg max-h-48 object-cover">
                    <p class="text-sm text-gray-600 mt-2">Image Preview</p>
                `;
                imageInput.parentNode.appendChild(preview);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = 'rgba(239, 68, 68, 0.5)';
                isValid = false;
            } else {
                field.style.borderColor = 'rgba(16, 185, 129, 0.2)';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields');
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
        }, index * 150);
    });
    
    // Auto-focus on the first input
    setTimeout(() => {
        codeInput.focus();
    }, 500);
});

// Utility functions
function showTooltip(element, message) {
    hideTooltip(element);
    const tooltip = document.createElement('div');
    tooltip.className = 'validation-tooltip absolute bg-red-100 text-red-700 text-xs px-2 py-1 rounded mt-1 z-10';
    tooltip.textContent = message;
    element.parentNode.style.position = 'relative';
    element.parentNode.appendChild(tooltip);
}

function hideTooltip(element) {
    const tooltip = element.parentNode.querySelector('.validation-tooltip');
    if (tooltip) tooltip.remove();
}
</script>

@endsection