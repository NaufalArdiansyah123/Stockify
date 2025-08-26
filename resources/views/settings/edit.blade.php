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
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-color: rgba(239, 68, 68, 0.3);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-color: rgba(245, 158, 11, 0.3);
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
    
    .settings-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .tab-button {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        border: 2px solid rgba(139, 92, 246, 0.2);
        background: rgba(255, 255, 255, 0.7);
        color: #6b7280;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    
    .tab-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .tab-button.active {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1));
        border-color: rgba(139, 92, 246, 0.4);
        color: #7c3aed;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.2);
    }
    
    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .security-info {
        background: rgba(59, 130, 246, 0.1);
        border-left: 4px solid #3b82f6;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }
    
    .warning-info {
        background: rgba(245, 158, 11, 0.1);
        border-left: 4px solid #f59e0b;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }
    
    .danger-info {
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-online {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .status-error {
        background: rgba(239, 68, 68, 0.1);
        color: #991b1b;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .system-metric {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(139, 92, 246, 0.1);
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .system-metric:hover {
        background: rgba(139, 92, 246, 0.05);
        transform: translateX(5px);
    }
    
    .progress-bar {
        width: 100%;
        height: 8px;
        background: rgba(156, 163, 175, 0.2);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 0.5rem;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.5s ease;
    }
    
    .progress-low { background: linear-gradient(135deg, #10b981, #059669); }
    .progress-medium { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .progress-high { background: linear-gradient(135deg, #ef4444, #dc2626); }
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

            {{-- Settings Tabs --}}
            <div class="settings-tabs">
                <button class="tab-button active" data-tab="general">
                    <span class="mr-2">🏢</span>
                    General Settings
                </button>
                <button class="tab-button" data-tab="security">
                    <span class="mr-2">🔒</span>
                    Security
                </button>
                <button class="tab-button" data-tab="system">
                    <span class="mr-2">⚡</span>
                    System Info
                </button>
            </div>

            {{-- General Settings Tab --}}
            <div id="general-tab" class="tab-content active">
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
            </div>

            {{-- Security Tab --}}
            <div id="security-tab" class="tab-content">
                <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Security Configuration</h2>
                            <p class="text-gray-600 text-sm">Manage system security settings and access controls</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
                            <span class="text-red-600 text-sm font-semibold">Security Panel</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Password Policy --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">🔐</span>
                                Password Policy
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="input-group">
                                    <label class="form-label">
                                        <span>🔢</span>
                                        Minimum Password Length
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon">🔢</div>
                                        <input type="number" class="form-input has-icon w-full" value="8" min="6" max="20">
                                    </div>
                                </div>
                                
                                <div class="input-group">
                                    <label class="form-label">
                                        <span>⏰</span>
                                        Password Expiry (Days)
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon">⏰</div>
                                        <input type="number" class="form-input has-icon w-full" value="90" min="30" max="365">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600" checked>
                                    <span class="text-gray-700">Require uppercase letters</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600" checked>
                                    <span class="text-gray-700">Require lowercase letters</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600" checked>
                                    <span class="text-gray-700">Require numbers</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600">
                                    <span class="text-gray-700">Require special characters</span>
                                </label>
                            </div>
                        </div>

                        {{-- Session Management --}}
                        <div class="space-y-4 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">⏳</span>
                                Session Management
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="input-group">
                                    <label class="form-label">
                                        <span>⏱️</span>
                                        Session Timeout (Minutes)
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon">⏱️</div>
                                        <input type="number" class="form-input has-icon w-full" value="30" min="5" max="480">
                                    </div>
                                </div>
                                
                                <div class="input-group">
                                    <label class="form-label">
                                        <span>🚪</span>
                                        Max Login Attempts
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon">🚪</div>
                                        <input type="number" class="form-input has-icon w-full" value="5" min="3" max="10">
                                    </div>
                                </div>
                            </div>
                            
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600" checked>
                                <span class="text-gray-700">Enable automatic logout on inactivity</span>
                            </label>
                        </div>

                        {{-- Two-Factor Authentication --}}
                        <div class="space-y-4 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">📱</span>
                                Two-Factor Authentication
                            </h3>
                            
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600">
                                    <span class="text-gray-700">Enable 2FA for all users</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600" checked>
                                    <span class="text-gray-700">Enable 2FA for administrators</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600">
                                    <span class="text-gray-700">Force 2FA on first login</span>
                                </label>
                            </div>
                        </div>

                        {{-- Security Actions --}}
                        <div class="flex items-center justify-between space-x-4 pt-6 border-t border-gray-200">
                            <div class="flex items-center space-x-3 text-sm text-gray-600">
                                <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                                <span>Security settings require admin approval</span>
                            </div>
                            
                            <div class="flex space-x-3">
                                <button type="button" class="action-btn btn-warning">
                                    <span class="mr-2">🔄</span>
                                    Reset to Default
                                </button>
                                <button type="button" class="action-btn btn-primary">
                                    <span class="mr-2">🔒</span>
                                    Apply Security Settings
                                </button>
                            </div>
                        </div>

                        {{-- Security Alerts --}}
                        <div class="danger-info">
                            <p class="text-red-800 text-sm">
                                <strong>⚠️ Security Warning:</strong> Changing security settings will affect all users. Ensure you have proper access before applying changes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- System Info Tab --}}
            <div id="system-tab" class="tab-content">
                <div class="industrial-card rounded-2xl p-8 hover-lift industrial-border">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">System Information</h2>
                            <p class="text-gray-600 text-sm">Monitor system health, performance, and technical details</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-green-600 text-sm font-semibold">System Online</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- System Status --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">📊</span>
                                System Status
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="system-metric">
                                    <div>
                                        <p class="text-sm text-gray-600">CPU Usage</p>
                                        <p class="text-lg font-bold text-gray-800">45%</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill progress-low" style="width: 45%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div>
                                        <p class="text-sm text-gray-600">Memory Usage</p>
                                        <p class="text-lg font-bold text-gray-800">62%</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill progress-medium" style="width: 62%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div>
                                        <p class="text-sm text-gray-600">Disk Usage</p>
                                        <p class="text-lg font-bold text-gray-800">78%</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill progress-medium" style="width: 78%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div>
                                        <p class="text-sm text-gray-600">Network I/O</p>
                                        <p class="text-lg font-bold text-gray-800">23%</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill progress-low" style="width: 23%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- System Information --}}
                        <div class="space-y-4 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">ℹ️</span>
                                Technical Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Application Version:</span>
                                        <span class="status-badge status-online">v2.0.1</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">PHP Version:</span>
                                        <span class="text-gray-800 font-semibold">{{ phpversion() ?? '8.2.0' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Laravel Version:</span>
                                        <span class="text-gray-800 font-semibold">{{ app()->version() ?? '10.0' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Environment:</span>
                                        <span class="status-badge {{ app()->environment() === 'production' ? 'status-online' : 'status-warning' }}">
                                            {{ ucfirst(app()->environment() ?? 'local') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Debug Mode:</span>
                                        <span class="status-badge {{ config('app.debug') ? 'status-warning' : 'status-online' }}">
                                            {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Database Status:</span>
                                        <span class="status-badge status-online">Connected</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Cache Status:</span>
                                        <span class="status-badge status-online">Active</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Queue Status:</span>
                                        <span class="status-badge status-warning">Idle</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Storage Status:</span>
                                        <span class="status-badge status-online">Writable</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Mail Status:</span>
                                        <span class="status-badge status-online">Configured</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- System Services --}}
                        <div class="space-y-4 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="mr-2">🔧</span>
                                System Services
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Web Server</p>
                                            <p class="text-xs text-gray-500">Nginx/Apache</p>
                                        </div>
                                        <span class="status-badge status-online">Running</span>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Database</p>
                                            <p class="text-xs text-gray-500">MySQL/PostgreSQL</p>
                                        </div>
                                        <span class="status-badge status-online">Running</span>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Redis Cache</p>
                                            <p class="text-xs text-gray-500">Cache Service</p>
                                        </div>
                                        <span class="status-badge status-online">Running</span>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Queue Worker</p>
                                            <p class="text-xs text-gray-500">Background Jobs</p>
                                        </div>
                                        <span class="status-badge status-warning">Stopped</span>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Scheduler</p>
                                            <p class="text-xs text-gray-500">Cron Jobs</p>
                                        </div>
                                        <span class="status-badge status-online">Running</span>
                                    </div>
                                </div>
                                
                                <div class="system-metric">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">File Storage</p>
                                            <p class="text-xs text-gray-500">Upload System</p>
                                        </div>
                                        <span class="status-badge status-online">Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- System Actions --}}
                        <div class="flex items-center justify-between space-x-4 pt-6 border-t border-gray-200">
                            <div class="flex items-center space-x-3 text-sm text-gray-600">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                <span>Last system check: {{ now()->format('H:i:s') }}</span>
                            </div>
                            
                            <div class="flex space-x-3">
                                <button type="button" class="action-btn btn-secondary" onclick="refreshSystemInfo()">
                                    <span class="mr-2">🔄</span>
                                    Refresh Data
                                </button>
                                <button type="button" class="action-btn btn-warning">
                                    <span class="mr-2">🧹</span>
                                    Clear Cache
                                </button>
                                <button type="button" class="action-btn btn-danger">
                                    <span class="mr-2">⚠️</span>
                                    System Maintenance
                                </button>
                            </div>
                        </div>

                        {{-- System Alerts --}}
                        <div class="warning-info">
                            <p class="text-yellow-800 text-sm">
                                <strong>💡 System Notice:</strong> Queue worker is currently stopped. Some background tasks may be delayed. Consider starting the queue worker for optimal performance.
                            </p>
                        </div>
                        
                        <div class="security-info">
                            <p class="text-blue-800 text-sm">
                                <strong>🔒 Security Recommendation:</strong> Regular system monitoring and maintenance are recommended. Ensure all components are updated for optimal security and performance.
                            </p>
                        </div>
                    </div>
                </div>
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
        
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                
                // Remove active class from all tabs and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                document.getElementById(tabName + '-tab').classList.add('active');
                
                // Show notification
                showNotification(`Switched to ${tabName.charAt(0).toUpperCase() + tabName.slice(1)} settings`, 'info');
            });
        });
        
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
    
    // Refresh system info function
    function refreshSystemInfo() {
        showNotification('Refreshing system information...', 'info');
        
        // Simulate data refresh
        setTimeout(() => {
            // Update progress bars with random values for demo
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const randomWidth = Math.floor(Math.random() * 100) + 1;
                bar.style.width = randomWidth + '%';
                
                // Update progress color based on value
                bar.className = 'progress-fill';
                if (randomWidth < 50) {
                    bar.classList.add('progress-low');
                } else if (randomWidth < 80) {
                    bar.classList.add('progress-medium');
                } else {
                    bar.classList.add('progress-high');
                }
            });
            
            showNotification('System information updated', 'success');
        }, 1500);
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