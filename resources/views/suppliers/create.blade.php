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
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(99, 102, 241, 0.2);
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        font-weight: 500;
        color: #374151;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .form-input:focus {
        outline: none;
        border-color: rgba(99, 102, 241, 0.6);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 
            0 0 0 4px rgba(99, 102, 241, 0.1),
            0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .form-input::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .form-label span {
        margin-right: 0.5rem;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.8);
        color: #374151;
        border-color: rgba(156, 163, 175, 0.3);
    }
    
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #6b7280;
        z-index: 10;
    }
    
    .form-input.has-icon {
        padding-left: 3.5rem;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        space-x: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }
    
    .breadcrumb a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .breadcrumb a:hover {
        color: #1d4ed8;
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
                        <div class="breadcrumb">
                            <a href="{{ route('suppliers.index') }}">Suppliers</a>
                            <span>→</span>
                            <span>Add New Supplier</span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            Add New Supplier
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Expand your industrial supply network</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Form Ready</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Form Container --}}
        <div class="form-container">
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Supplier Information</h2>
                        <p class="text-gray-600 text-sm">Enter the details for the new supplier</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                        <span class="text-blue-600 text-sm font-semibold">Form Validation Active</span>
                    </div>
                </div>

                <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6" id="supplierForm">
                    @csrf
                    
                    {{-- Supplier Name Field --}}
                    <div class="input-group">
                        <label for="name" class="form-label">
                            <span>🏢</span>
                            Supplier Name
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="input-icon">🏢</div>
                            <input 
                                type="text" 
                                name="name" 
                                id="name"
                                placeholder="Enter supplier company name"
                                class="form-input has-icon w-full"
                                required
                                autocomplete="organization"
                            >
                        </div>
                    </div>
                    
                    {{-- Contact Field --}}
                    <div class="input-group">
                        <label for="contact" class="form-label">
                            <span>📞</span>
                            Contact Information
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="input-icon">📞</div>
                            <input 
                                type="text" 
                                name="contact_person" 
                                id="contact_person"
                                placeholder="Phone number, email, or contact person"
                                class="form-input has-icon w-full"
                                required
                                autocomplete="tel"
                            >
                        </div>
                    </div>
                    
                    {{-- Address Field --}}
                    <div class="input-group">
                        <label for="address" class="form-label">
                            <span>📍</span>
                            Business Address
                            <span class="text-gray-500 ml-1 text-xs">(Optional)</span>
                        </label>
                        <div class="relative">
                            <div class="input-icon">📍</div>
                            <input 
                                type="text" 
                                name="address" 
                                id="address"
                                placeholder="Complete business address"
                                class="form-input has-icon w-full"
                                autocomplete="street-address"
                            >
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('suppliers.index') }}" class="action-btn btn-secondary">
                            <span class="mr-2">←</span>
                            Back to List
                        </a>
                        
                        <div class="flex space-x-3">
                            <button type="reset" class="action-btn btn-secondary" onclick="resetForm()">
                                <span class="mr-2">🔄</span>
                                Reset Form
                            </button>
                            <button type="submit" class="action-btn btn-primary">
                                <span class="mr-2">💾</span>
                                Save Supplier
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Help Card --}}
            <div class="industrial-card rounded-2xl p-6 mt-6 industrial-border">
                <div class="flex items-start space-x-4">
                    <div class="metric-icon p-3 rounded-xl" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <span class="text-xl text-white">💡</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Supplier Registration Guidelines</h3>
                        <div class="text-gray-600 text-sm space-y-2">
                            <p>• <strong>Supplier Name:</strong> Enter the official company or business name as it appears in legal documents</p>
                            <p>• <strong>Contact Info:</strong> Provide primary phone number, email, or key contact person details</p>
                            <p>• <strong>Address:</strong> Complete business address helps with logistics and delivery planning</p>
                        </div>
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                            <p class="text-blue-800 text-sm">
                                <strong>Tip:</strong> All supplier information can be updated later through the edit function.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Status Footer --}}
        <div class="industrial-card rounded-2xl p-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-6 text-gray-600">
                    <span>Form Module: <strong class="text-green-600">Active</strong></span>
                    <span>Validation: <strong class="text-green-600">Enabled</strong></span>
                    <span>Auto-save: <strong class="text-gray-700">Disabled</strong></span>
                </div>
                <div class="text-gray-500">
                    Industrial Supply Chain Management © 2024
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('supplierForm');
        const inputs = form.querySelectorAll('.form-input');
        
        // Add real-time validation
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateField(this);
            });
            
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
        
        // Form submission with validation
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Please correct the highlighted fields before submitting.', 'error');
            } else {
                showNotification('Saving supplier information...', 'success');
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
    });
    
    // Field validation function
    function validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        let isValid = true;
        
        // Remove existing error styles
        field.style.borderColor = 'rgba(99, 102, 241, 0.2)';
        field.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        
        // Check required fields
        if (isRequired && value === '') {
            isValid = false;
            field.style.borderColor = '#ef4444';
            field.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        }
        
        // Validate contact field format
        if (field.name === 'contact' && value !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            
            if (!emailRegex.test(value) && !phoneRegex.test(value.replace(/[\s\-\(\)]/g, ''))) {
                // If it's not email or phone, assume it's a contact name (allow it)
                if (value.length < 2) {
                    isValid = false;
                    field.style.borderColor = '#f59e0b';
                    field.style.boxShadow = '0 0 0 4px rgba(245, 158, 11, 0.1)';
                }
            }
        }
        
        return isValid;
    }
    
    // Reset form function
    function resetForm() {
        const form = document.getElementById('supplierForm');
        form.reset();
        
        // Reset all field styles
        const inputs = form.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.style.borderColor = 'rgba(99, 102, 241, 0.2)';
            input.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        });
        
        showNotification('Form has been reset', 'info');
    }
    
    // Simple notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white font-semibold z-50 transition-all duration-300 transform translate-x-full`;
        
        switch (type) {
            case 'success':
                notification.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                break;
            case 'error':
                notification.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
                break;
            case 'info':
                notification.style.background = 'linear-gradient(135deg, #3b82f6, #1d4ed8)';
                break;
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            notification.style.transform = 'translateX(full)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        // Update any time display elements if they exist
    }
    
    setInterval(updateTime, 1000);
</script>
@endsection