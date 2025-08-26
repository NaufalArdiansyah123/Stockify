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
    
    .industrial-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(99, 102, 241, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(99, 102, 241, 0.5);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
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
    }
    
    .industrial-button-secondary {
        background: linear-gradient(135deg, #6b7280, #9ca3af);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
    }
    
    .industrial-button-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 114, 128, 0.6);
    }
    
    .form-label {
        color: #374151;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .form-label::before {
        content: '';
        width: 4px;
        height: 16px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 2px;
        margin-right: 8px;
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
                            Stock Opname Control
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Physical Inventory Verification System</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700 mb-1">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Recording Mode</span>
                    </div>
                    <span class="text-lg text-gray-800">New Audit Entry</span>
                </div>
            </div>
        </div>

        {{-- Enhanced Form Container --}}
        <div class="max-w-2xl mx-auto">
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <form action="{{ route('stockopname.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Product Selection --}}
                    <div>
                        <label class="form-label">
                            Product Selection
                        </label>
                        <div class="relative">
                            <select name="product_id" class="w-full px-4 py-3 rounded-xl industrial-input text-gray-800 font-medium">
                                <option value="" disabled selected>Choose product to audit...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }} (System Stock: {{ number_format($product->stock) }} units)
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-2">Select the product you want to perform stock opname on</p>
                    </div>

                    {{-- Physical Stock Input --}}
                    <div>
                        <label class="form-label">
                            Physical Stock Count
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   name="real_stock" 
                                   class="w-full px-4 py-3 rounded-xl industrial-input text-gray-800 font-bold text-lg" 
                                   placeholder="Enter actual counted units..."
                                   min="0"
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <span class="text-gray-400 text-sm font-medium">UNITS</span>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-2">Input the actual physical count from your inventory audit</p>
                    </div>

                    {{-- Notes Section --}}
                    <div>
                        <label class="form-label">
                            Audit Notes
                        </label>
                        <textarea name="note" 
                                  rows="4" 
                                  class="w-full px-4 py-3 rounded-xl industrial-input text-gray-800 resize-none" 
                                  placeholder="Record any observations, discrepancies, or additional details about the stock count..."></textarea>
                        <p class="text-gray-500 text-sm mt-2">Optional: Add notes about the audit process or findings</p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('stockopname.index') }}" 
                           class="px-6 py-3 rounded-xl industrial-button-secondary hover-lift">
                            Cancel Audit
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 rounded-xl industrial-button hover-lift">
                            Record Opname
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Audit System: <strong class="text-green-600">Active</strong></span>
                    <span>Session: <strong class="text-gray-700">{{ Auth::user()->name }}</strong></span>
                    <span>Timestamp: <strong class="text-gray-700">{{ now()->format('d M Y H:i:s') }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>
@endsection