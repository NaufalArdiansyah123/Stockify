{{-- edit.blade.php --}}
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
        background: linear-gradient(90deg, transparent, #f59e0b, transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .metric-icon {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        box-shadow: 
            0 10px 20px rgba(245, 158, 11, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(217, 119, 6, 0.1) 0%, transparent 50%);
    }
    
    .industrial-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(245, 158, 11, 0.2);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        border-color: rgba(245, 158, 11, 0.6);
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 
            0 10px 20px rgba(16, 185, 129, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(16, 185, 129, 0.4),
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
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
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
                        <span class="text-2xl text-white">✏️</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Edit Stock Transaction
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Modify existing inventory movement record</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="status-badge {{ $stockMovement->type == 'IN' ? 'status-in' : 'status-out' }}">
                            {{ $stockMovement->type == 'IN' ? '↗ IN' : '↙ OUT' }}
                        </span>
                    </div>
                    <a href="{{ route('stock.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg">
                        ← Back to List
                    </a>
                </div>
            </div>
        </div>

        {{-- Transaction Info Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="industrial-card rounded-2xl p-6 hover-lift">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white text-lg">📦</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Original Product</p>
                        <p class="text-lg font-bold text-gray-800">{{ $stockMovement->product->name ?? 'Unknown' }}</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <span class="text-white text-lg">🔢</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Current Quantity</p>
                        <p class="text-lg font-bold text-gray-800">{{ $stockMovement->qty }} units</p>
                    </div>
                </div>
            </div>

            <div class="industrial-card rounded-2xl p-6 hover-lift">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <span class="text-white text-lg">📅</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Transaction Date</p>
                        <p class="text-lg font-bold text-gray-800">{{ $stockMovement->happened_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Edit Form --}}
        <div class="max-w-4xl mx-auto">
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Update Transaction Details</h2>
                    <p class="text-gray-600">Modify the information below to update this transaction</p>
                </div>

                <form action="{{ route('stock.update',$stockMovement->id) }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Product Selection --}}
                        <div class="form-section p-6">
                            <label class="block text-gray-700 font-semibold mb-3">
                                <span class="flex items-center space-x-2">
                                    <span class="text-lg">📦</span>
                                    <span>Product Selection</span>
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <select name="product_id" class="industrial-input w-full p-4 text-gray-700 font-medium" required>
                                <option value="">Select a product...</option>
                                @foreach(\App\Models\Product::all() as $p)
                                    <option value="{{ $p->id }}" @if($stockMovement->product_id==$p->id) selected @endif>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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
                                <option value="IN" @if($stockMovement->type=='IN') selected @endif>📈 Stock In (Incoming)</option>
                                <option value="OUT" @if($stockMovement->type=='OUT') selected @endif>📉 Stock Out (Outgoing)</option>
                            </select>
                        </div>
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
                               value="{{ $stockMovement->qty }}"
                               class="industrial-input w-full p-4 text-gray-700 font-medium text-lg" 
                               placeholder="Enter quantity (e.g., 100)"
                               min="1"
                               required>
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
                                  placeholder="Add any additional information about this transaction...">{{ $stockMovement->note }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <div class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></div>
                            <span class="text-sm">Editing existing transaction ID: #{{ $stockMovement->id }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('stock.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="industrial-button text-white px-8 py-4 rounded-xl font-semibold hover-lift flex items-center space-x-2">
                                <span class="text-xl">✅</span>
                                <span>Update Transaction</span>
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
                    <span>Edit Mode: <strong class="text-amber-600">Active</strong></span>
                    <span>Transaction ID: <strong class="text-gray-700">#{{ $stockMovement->id }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Stock Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form enhancements
    document.addEventListener('DOMContentLoaded', function() {
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

        // Highlight changes
        inputs.forEach(input => {
            const originalValue = input.value || input.textContent;
            input.addEventListener('input', function() {
                if (this.value !== originalValue) {
                    this.style.backgroundColor = 'rgba(245, 158, 11, 0.1)';
                } else {
                    this.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
                }
            });
        });
    });
</script>
@endsection