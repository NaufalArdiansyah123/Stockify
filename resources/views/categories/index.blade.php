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
    
    .category-count {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.2);
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
                        <span class="text-2xl text-white">🏷️</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Category Management
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Organize your inventory categories</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="category-count px-4 py-2 rounded-xl">
                        <span class="text-sm font-semibold text-indigo-700">
                            Total Categories: {{ $categories->count() }}
                        </span>
                    </div>
                    <a href="{{ route('categories.create') }}" 
                       class="industrial-button px-6 py-3 text-white rounded-xl font-semibold flex items-center space-x-2">
                        <span class="text-lg">➕</span>
                        <span>Add Category</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Enhanced Categories Table --}}
        <div class="industrial-card rounded-2xl p-6 industrial-border">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Categories Overview</h2>
                    <p class="text-gray-600 text-sm">Manage and organize product categories</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                    <span class="text-green-600 text-sm font-semibold">Active</span>
                </div>
            </div>
            
            @if($categories->count() > 0)
                <div class="overflow-hidden rounded-xl border border-gray-300">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-100/70">
                                <tr>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">🏷️</span>
                                            Category Name
                                        </div>
                                    </th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">📊</span>
                                            Product Count
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
                                @foreach ($categories as $category)
                                <tr class="activity-row">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-indigo-400 rounded-full mr-3 pulse-glow"></div>
                                            <div>
                                                <span class="text-gray-800 font-semibold text-lg">{{ $category->name }}</span>
                                                <div class="text-gray-500 text-sm">Category ID: #{{ $category->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <span class="text-gray-800 font-bold text-lg">
                                                {{ $category->products_count }}
                                            </span>
                                            <span class="text-gray-500 text-sm ml-2">products</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('categories.edit', $category) }}" 
                                               class="action-button edit-button px-4 py-2 text-white rounded-lg font-semibold flex items-center space-x-2">
                                                <span class="text-sm">✏️</span>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="action-button delete-button px-4 py-2 text-white rounded-lg font-semibold flex items-center space-x-2"
                                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <span class="text-sm">🗑️</span>
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
            @else
                <div class="py-16 text-center">
                    <div class="flex flex-col items-center">
                        <div class="industrial-card w-24 h-24 rounded-full flex items-center justify-center mb-6 hover-lift">
                            <span class="text-4xl">🏷️</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Categories Found</h3>
                        <p class="text-gray-600 text-lg mb-6">Start by creating your first product category</p>
                        <a href="{{ route('categories.create') }}" 
                           class="industrial-button px-8 py-4 text-white rounded-xl font-semibold flex items-center space-x-3 hover-lift">
                            <span class="text-xl">➕</span>
                            <span>Create Your First Category</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Category System: <strong class="text-green-600">Active</strong></span>
                    <span>Last Update: <strong class="text-gray-700">{{ now()->format('H:i:s') }}</strong></span>
                    <span>Total Categories: <strong class="text-gray-700">{{ $categories->count() }}</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Inventory Management System © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

@endsection