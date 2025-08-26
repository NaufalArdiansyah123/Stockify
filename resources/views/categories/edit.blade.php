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
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .industrial-button {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        box-shadow: 
            0 10px 20px rgba(245, 158, 11, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .industrial-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 15px 30px rgba(245, 158, 11, 0.4),
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
        border: 2px solid rgba(245, 158, 11, 0.2);
        transition: all 0.3s ease;
    }
    
    .industrial-input:focus {
        border-color: rgba(245, 158, 11, 0.5);
        box-shadow: 
            0 0 20px rgba(245, 158, 11, 0.2),
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
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.3);
        }
        50% { 
            box-shadow: 0 0 40px rgba(245, 158, 11, 0.6);
        }
    }
    
    .category-info {
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.2);
        backdrop-filter: blur(10px);
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
                            Edit Category
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Modify category information</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="category-info px-4 py-2 rounded-xl">
                        <span class="text-sm font-semibold text-amber-700">
                            ID: #{{ $category->id }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-amber-400 rounded-full pulse-glow"></div>
                        <span class="text-amber-600 text-sm font-semibold">Edit Mode</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Form Section --}}
        <div class="max-w-2xl mx-auto">
            <div class="form-container rounded-2xl p-8 hover-lift industrial-border">
                <div class="text-center mb-8">
                    <div class="industrial-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 hover-lift">
                        <span class="text-3xl">🏷️</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Update Category</h2>
                    <p class="text-gray-600">Modify the category details below</p>
                </div>

                {{-- Current Category Info --}}
                <div class="category-info rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-sm font-semibold text-amber-700 uppercase tracking-wide">Current Category</span>
                            <div class="text-lg font-bold text-amber-800 mt-1">{{ $category->name }}</div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-amber-600">Created</span>
                            <div class="text-sm font-semibold text-amber-700">
                                {{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            <span class="flex items-center">
                                <span class="text-lg mr-2">🏷️</span>
                                Category Name
                            </span>
                        </label>
                        <input type="text" 
                               id="name"
                               name="name" 
                               value="{{ $category->name }}"
                               placeholder="Enter category name"
                               class="industrial-input w-full px-4 py-4 rounded-xl text-lg font-medium"
                               required
                               maxlength="100">
                        <div class="text-xs text-gray-500 mt-1">
                            Update the category name to better describe its purpose
                        </div>
                    </div>

                    <div class="flex space-x-4 pt-6">
                        <button type="submit" 
                                class="industrial-button flex-1 px-6 py-4 text-white rounded-xl font-bold text-lg flex items-center justify-center space-x-3">
                            <span class="text-xl">💾</span>
                            <span>Update Category</span>
                        </button>
                        
                        <a href="{{ route('categories.index') }}" 
                           class="back-button px-6 py-4 text-white rounded-xl font-bold text-lg flex items-center justify-center space-x-3 hover-lift transition-all duration-300">
                            <span class="text-xl">↩️</span>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Change History Section --}}
        <div class="max-w-2xl mx-auto">
            <div class="industrial-card rounded-2xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-xl">📝</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Edit Guidelines</h3>
                </div>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex items-start space-x-3">
                        <span class="text-amber-500 mt-1">•</span>
                        <span>Changing the category name will update it across all associated products</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span class="text-amber-500 mt-1">•</span>
                        <span>Make sure the new name clearly identifies the category's purpose</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span class="text-amber-500 mt-1">•</span>
                        <span>Consider how this change might affect product organization</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span class="text-amber-500 mt-1">•</span>
                        <span>All changes are logged and can be tracked in the system</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Edit Status: <strong class="text-amber-600">Active</strong></span>
                    <span>Category ID: <strong class="text-gray-700">#{{ $category->id }}</strong></span>
                    <span>Last Modified: <strong class="text-gray-700">{{ $category->updated_at ? $category->updated_at->format('H:i:s') : 'Never' }}</strong></span>
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
    const nameInput = document.getElementById('name');
    const form = document.querySelector('form');
    const originalName = nameInput.value;
    
    // Add character counter
    const charCounter = document.createElement('div');
    charCounter.className = 'text-xs text-gray-500 text-right mt-1';
    charCounter.textContent = `${nameInput.value.length}/100 characters`;
    nameInput.parentNode.appendChild(charCounter);
    
    // Track changes
    const changeIndicator = document.createElement('div');
    changeIndicator.className = 'text-xs text-amber-600 mt-1 hidden';
    changeIndicator.innerHTML = '⚠️ Changes detected - remember to save';
    nameInput.parentNode.appendChild(changeIndicator);
    
    nameInput.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.textContent = `${length}/100 characters`;
        
        // Show change indicator
        if (this.value !== originalName) {
            changeIndicator.classList.remove('hidden');
        } else {
            changeIndicator.classList.add('hidden');
        }
        
        if (length > 80) {
            charCounter.classList.add('text-orange-500');
            charCounter.classList.remove('text-gray-500');
        } else {
            charCounter.classList.add('text-gray-500');
            charCounter.classList.remove('text-orange-500');
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
    
    // Auto-focus and select text on the name input
    setTimeout(() => {
        nameInput.focus();
        nameInput.select();
    }, 500);
    
    // Warn before leaving if there are unsaved changes
    window.addEventListener('beforeunload', function(e) {
        if (nameInput.value !== originalName) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
    
    // Remove warning when form is submitted
    form.addEventListener('submit', function() {
        window.removeEventListener('beforeunload', arguments.callee);
    });
});
</script>

@endsection