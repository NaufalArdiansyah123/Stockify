{{-- create.blade.php - Modified for Stock Confirmation System --}}
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
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(99, 102, 241, 0.2);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        border-color: rgba(99, 102, 241, 0.6);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        box-shadow: 
            0 10px 20px rgba(99, 102, 241, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(99, 102, 241, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .form-section {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    
    .form-section:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .product-toggle {
        background: rgba(99, 102, 241, 0.1);
        border: 2px solid rgba(99, 102, 241, 0.2);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    /* New styles for confirmation system */
    .confirmation-notice {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 1px solid #f59e0b;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
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
                            Create Stock Request
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Request stock change (requires staff confirmation)</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Current Time</div>
                        <div class="text-lg font-semibold text-gray-700" id="current-time"></div>
                    </div>
                    <a href="{{ route('stock.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg">
                        ← Back to List
                    </a>
                </div>
            </div>
        </div>

        {{-- Confirmation Notice --}}
        <div class="confirmation-notice">
            <div class="flex items-center space-x-3">
                <span class="text-2xl">⏳</span>
                <div>
                    <h3 class="font-semibold text-amber-800">Confirmation Required</h3>
                    <p class="text-amber-700 text-sm">This stock change request will be sent to staff for confirmation. Stock will not be updated until approved.</p>
                </div>
            </div>
        </div>

        {{-- Enhanced Form --}}
        <div class="max-w-4xl mx-auto">
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Request Details</h2>
                    <p class="text-gray-600">Please fill in all required information</p>
                </div>

                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- PERUBAHAN PENTING: Ubah action form ke route stock.request.store --}}
                <form action="{{ route('stock.request.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Product Selection - ENHANCED --}}
                    <div class="form-section p-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <span class="flex items-center space-x-2">
                                <span class="text-lg">📦</span>
                                <span>Product Selection</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        
                        {{-- Toggle untuk pilih existing atau buat baru --}}
                        <div class="product-toggle">
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="product_option" value="existing" checked 
                                           class="text-indigo-600 focus:ring-indigo-500" onchange="toggleProductInput()">
                                    <span class="text-sm font-medium text-gray-700">Select Existing Product</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="product_option" value="new" 
                                           class="text-indigo-600 focus:ring-indigo-500" onchange="toggleProductInput()">
                                    <span class="text-sm font-medium text-gray-700">Create New Product</span>
                                </label>
                            </div>
                        </div>

                        {{-- Existing Product Dropdown --}}
                        <div id="existing-product" class="space-y-4">
                            <select name="product_id" id="product_select" class="industrial-input w-full p-4 text-gray-700 font-medium">
                                <option value="">Select a product...</option>
                                @foreach(\App\Models\Product::with(['category', 'supplier'])->get() as $p)
                                    <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }} - Stock: {{ $p->stock }} - {{ $p->category->name ?? 'No Category' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- New Product Input --}}
                        <div id="new-product" class="space-y-4 hidden">
                            <input type="text" 
                                   name="product_name" 
                                   id="product_name"
                                   value="{{ old('product_name') }}"
                                   class="industrial-input w-full p-4 text-gray-700 font-medium" 
                                   placeholder="Enter product name (e.g., Tepung Terigu Premium)">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Category Selection --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Category <span class="text-red-500">*</span>
                                    </label>
                                    <select name="category_id" id="category_select" class="industrial-input w-full p-3 text-gray-700">
                                        <option value="">Select category...</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                {{-- Supplier Selection --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Supplier <span class="text-red-500">*</span>
                                    </label>
                                    <select name="supplier_id" id="supplier_select" class="industrial-input w-full p-3 text-gray-700">
                                        <option value="">Select supplier...</option>
                                        @foreach(\App\Models\Supplier::all() as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Price Buy --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Price (Rp)</label>
                                    <input type="number" 
                                           name="price_buy" 
                                           step="0.01"
                                           min="0"
                                           value="{{ old('price_buy') }}"
                                           class="industrial-input w-full p-3 text-gray-700" 
                                           placeholder="1000.00">
                                </div>
                                
                                {{-- Price Sell --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Selling Price (Rp)</label>
                                    <input type="number" 
                                           name="price_sell" 
                                           step="0.01"
                                           min="0"
                                           value="{{ old('price_sell') }}"
                                           class="industrial-input w-full p-3 text-gray-700" 
                                           placeholder="1500.00">
                                </div>
                            </div>

                            {{-- Stock Minimum --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Stock Alert</label>
                                <input type="number" 
                                       name="stock_minimum" 
                                       min="0"
                                       value="{{ old('stock_minimum', 10) }}"
                                       class="industrial-input w-full p-3 text-gray-700" 
                                       placeholder="10">
                                <p class="text-xs text-gray-500 mt-1">System will alert when stock goes below this number</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Transaction Type --}}
                        <div class="form-section p-6">
                            <label class="block text-gray-700 font-semibold mb-3">
                                <span class="flex items-center space-x-2">
                                    <span class="text-lg">🔄</span>
                                    <span>Transaction Type</span>
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <select name="type" class="industrial-input w-full p-4 text-gray-700 font-medium" required>
                                <option value="">Select type...</option>
                                <option value="IN" {{ old('type') == 'IN' ? 'selected' : '' }}>📈 Stock In (Incoming)</option>
                                <option value="OUT" {{ old('type') == 'OUT' ? 'selected' : '' }}>📉 Stock Out (Outgoing)</option>
                            </select>
                        </div>

                        {{-- Quantity Input --}}
                        <div class="form-section p-6">
                            <label class="block text-gray-700 font-semibold mb-3">
                                <span class="flex items-center space-x-2">
                                    <span class="text-lg">🔢</span>
                                    <span>Quantity</span>
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="number" 
                                   name="qty" 
                                   value="{{ old('qty') }}"
                                   class="industrial-input w-full p-4 text-gray-700 font-medium text-lg" 
                                   placeholder="Enter quantity (e.g., 100)"
                                   min="1"
                                   required>
                        </div>
                    </div>

                    {{-- Notes Section --}}
                    <div class="form-section p-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <span class="flex items-center space-x-2">
                                <span class="text-lg">📝</span>
                                <span>Additional Notes</span>
                                <span class="text-gray-500 text-sm font-normal">(Optional)</span>
                            </span>
                        </label>
                        <textarea name="note" 
                                  rows="4"
                                  class="industrial-input w-full p-4 text-gray-700 resize-none"
                                  placeholder="Add any additional information about this transaction...">{{ old('note') }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                            <span class="text-sm">Requires staff confirmation</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('stock.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="industrial-button text-white px-8 py-4 rounded-xl font-semibold hover-lift flex items-center space-x-2">
                                <span class="text-xl">📤</span>
                                <span>Submit Request</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>System Status: <strong class="text-green-600">Operational</strong></span>
                    <span>Form Validation: <strong class="text-blue-600">Active</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Stock Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleProductInput() {
        const existingDiv = document.getElementById('existing-product');
        const newDiv = document.getElementById('new-product');
        const productSelect = document.getElementById('product_select');
        const productName = document.getElementById('product_name');
        const categorySelect = document.getElementById('category_select');
        const supplierSelect = document.getElementById('supplier_select');
        const isExisting = document.querySelector('input[name="product_option"]:checked').value === 'existing';
        
        if (isExisting) {
            existingDiv.classList.remove('hidden');
            newDiv.classList.add('hidden');
            productSelect.required = true;
            productName.required = false;
            categorySelect.required = false;
            supplierSelect.required = false;
        } else {
            existingDiv.classList.add('hidden');
            newDiv.classList.remove('hidden');
            productSelect.required = false;
            productName.required = true;
            categorySelect.required = true;
            supplierSelect.required = true;
        }
    }

    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    setInterval(updateTime, 1000);
    updateTime(); // Initial call

    // Form enhancements
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize toggle
        toggleProductInput();
        
        // Restore product option state if coming back from validation error
        @if(old('product_option'))
            document.querySelector('input[name="product_option"][value="{{ old('product_option') }}"]').checked = true;
            toggleProductInput();
        @endif

        // Add subtle animations on load
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

        // Form validation feedback
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = 'rgba(16, 185, 129, 0.6)';
                } else {
                    this.style.borderColor = 'rgba(239, 68, 68, 0.6)';
                }
            });
        });
    });
</script>
@endsection