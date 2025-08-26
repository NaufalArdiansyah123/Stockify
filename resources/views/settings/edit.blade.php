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
        background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .metric-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        box-shadow: 
            0 10px 20px rgba(139, 92, 246, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .industrial-grid {
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(124, 58, 237, 0.1) 0%, transparent 50%);
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(139, 92, 246, 0.2);
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
        border-color: rgba(139, 92, 246, 0.6);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 
            0 0 0 4px rgba(139, 92, 246, 0.1),
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
        cursor: pointer;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border-color: rgba(139, 92, 246, 0.3);
    }
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.8);
        color: #374151;
        border-color: rgba(156, 163, 175, 0.3);
    }
    
    .form-container {
        max-width: 700px;
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
    
    .success-alert {
        background: rgba(16, 185, 129, 0.1);
        border: 2px solid rgba(16, 185, 129, 0.3);
        color: #065f46;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        backdrop-filter: blur(10px);
        animation: slideInDown 0.5s ease;
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .file-upload-area {
        border: 2px dashed rgba(139, 92, 246, 0.3);
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .file-upload-area:hover {
        border-color: rgba(139, 92, 246, 0.6);
        background: rgba(139, 92, 246, 0.05);
        transform: translateY(-2px);
    }
    
    .file-upload-area.dragover {
        border-color: rgba(139, 92, 246, 0.8);
        background: rgba(139, 92, 246, 0.1);
    }
    
    .logo-preview {
        max-width: 200px;
        max-height: 100px;
        object-fit: contain;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 2px solid rgba(139, 92, 246, 0.2);
    }
</style>

<div class="bg-gradient-dashboard min-h-screen industrial-grid">
    <div class="p-6 space-y-8">
        {{-- Enhanced Header --}}
        <div class="industrial-card rounded-2xl p-6 hover-lift industrial-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="metric-icon p-4 rounded-2xl floating-animation">
                        <span class="text-2xl text-white">⚙️</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            System Configuration
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">Industrial Application Settings & Preferences</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-2 text-gray-700">
                        <div class="w-2 h-2 bg-purple-400 rounded-full pulse-glow"></div>
                        <span class="text-sm">Settings Panel</span>
                    </div>
                    <span class="text-sm text-gray-600">Configure System</span>
                </div>
            </div>
        </div>

        {{-- Settings Form Container --}}
        <div class="form-container">
            {{-- Success Alert --}}
            @if(session('success'))
                <div class="success-alert">
                    <span class="text-xl mr-3">✅</span>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- General Settings Form --}}
            <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Application Configuration</h2>
                        <p class="text-gray-600 text-sm">Customize your industrial management system</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                        <span class="text-purple-600 text-sm font-semibold">Configuration Active</span>
                    </div>
                </div>

                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="settingsForm">
                    @csrf
                    
                    {{-- Application Name Field --}}
                    <div class="input-group">
                        <label for="app_name" class="form-label">
                            <span>🏢</span>
                            Application Name
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="input-icon">🏢</div>
                            <input 
                                type="text" 
                                name="app_name" 
                                id="app_name"
                                value="{{ old('app_name', $setting->app_name ?? 'Industrial Management System') }}"
                                placeholder="Enter your application name"
                                class="form-input has-icon w-full"
                                required
                                autocomplete="organization"
                            >
                        </div>
                        <p class="text-gray-500 text-xs mt-1">This name will appear in the header and browser title</p>
                    </div>
                    
                    {{-- Logo Upload Field --}}
                    <div class="input-group">
                        <label class="form-label">
                            <span>🎨</span>
                            Application Logo
                            <span class="text-gray-500 ml-1 text-xs">(Optional)</span>
                        </label>
                        
                        {{-- Current Logo Display --}}
                        @if(isset($setting->logo) && $setting->logo)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Current Logo:</p>
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border-2 border-gray-200">
                                    <img src="{{ asset('storage/'.$setting->logo) }}" class="logo-preview" alt="Current Logo">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">{{ basename($setting->logo) }}</p>
                                        <p class="text-xs text-gray-500">Current application logo</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        {{-- File Upload Area --}}
                        <div class="file-upload-area" id="logoUploadArea">
                            <div class="space-y-4">
                                <div class="metric-icon p-3 rounded-xl mx-auto w-fit" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                                    <span class="text-xl text-white">📁</span>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-semibold">Upload New Logo</p>
                                    <p class="text-gray-500 text-sm">Click to browse or drag and drop</p>
                                    <p class="text-gray-400 text-xs mt-1">Supported: JPG, PNG, GIF (Max: 2MB)</p>
                                </div>
                                <input type="file" name="logo" id="logoInput" class="hidden" accept="image/*">
                            </div>
                        </div>
                        
                        {{-- Preview Area --}}
                        <div id="logoPreview" class="hidden mt-4">
                            <p class="text-sm text-gray-600 mb-2">New Logo Preview:</p>
                            <div class="flex items-center space-x-4 p-4 bg-purple-50 rounded-lg border-2 border-purple-200">
                                <img id="previewImage" class="logo-preview" alt="Logo Preview">
                                <div>
                                    <p id="previewName" class="text-sm font-semibold text-gray-700"></p>
                                    <p id="previewSize" class="text-xs text-gray-500"></p>
                                    <button type="button" id="removePreview" class="text-red-500 text-xs hover:text-red-700 mt-1">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between space-x-4 pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <span>Settings will be applied immediately</span>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" class="action-btn btn-secondary" onclick="resetForm()">
                                <span class="mr-2">🔄</span>
                                Reset Changes
                            </button>
                            <button type="submit" class="action-btn btn-primary">
                                <span class="mr-2">💾</span>
                                Save Configuration
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- System Status Footer --}}
            <div class="industrial-card rounded-2xl p-4 mt-6">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center space-x-6 text-gray-600">
                        <span>Settings Module: <strong class="text-purple-600">Active</strong></span>
                        <span>Last Update: <strong class="text-gray-700" id="currentTime">{{ now()->format('H:i:s') }}</strong></span>
                        <span>Auto-save: <strong class="text-gray-700">Disabled</strong></span>
                    </div>
                    <div class="text-gray-500">
                        Industrial Management System © 2024
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Enhanced Settings Form Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('settingsForm');
        const logoUploadArea = document.getElementById('logoUploadArea');
        const logoInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('logoPreview');
        const previewImage = document.getElementById('previewImage');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');
        const removePreview = document.getElementById('removePreview');
        
        // File upload area interactions (only if elements exist)
        if (logoUploadArea && logoInput) {
            logoUploadArea.addEventListener('click', () => logoInput.click());
            
            logoUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            
            logoUploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
            
            logoUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelect(files[0]);
                }
            });
            
            logoInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0]);
                }
            });
        }
        
        if (removePreview) {
            removePreview.addEventListener('click', function() {
                logoInput.value = '';
                logoPreview.classList.add('hidden');
            });
        }
        
        // Handle file selection and preview
        function handleFileSelect(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                showNotification('Please select a valid image file', 'error');
                return;
            }
            
            // Validate file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                showNotification('File size must be less than 2MB', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewImage && previewName && previewSize && logoPreview) {
                    previewImage.src = e.target.result;
                    previewName.textContent = file.name;
                    previewSize.textContent = formatFileSize(file.size);
                    logoPreview.classList.remove('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Form validation and submission
        if (form) {
            form.addEventListener('submit', function(e) {
                const appName = document.getElementById('app_name');
                
                if (appName && appName.value.trim().length < 3) {
                    e.preventDefault();
                    showNotification('Application name must be at least 3 characters long', 'error');
                    return;
                }
                
                showNotification('Updating configuration...', 'success');
            });
        }
        
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
    
    // Reset form function
    function resetForm() {
        const form = document.getElementById('settingsForm');
        const logoPreview = document.getElementById('logoPreview');
        
        if (confirm('Are you sure you want to reset all changes?')) {
            if (form) form.reset();
            if (logoPreview) logoPreview.classList.add('hidden');
            showNotification('Form has been reset', 'info');
        }
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
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    
    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        const timeElement = document.getElementById('currentTime');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    setInterval(updateTime, 1000);
</script>
@endsection