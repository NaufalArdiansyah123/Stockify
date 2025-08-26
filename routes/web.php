<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingController;


// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public redirect
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'manager') {
            return redirect()->route('manager.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }
    }
    return redirect('/login');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===== ROUTES UNTUK STAFF (KONFIRMASI STOK) =====
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        Route::post('/staff/confirm/{id}', [StaffController::class, 'confirm'])->name('staff.confirm');
    });

    // ===== ROUTES UNTUK ADMIN/MANAGER (MEMBUAT PERMINTAAN STOK) =====
    Route::middleware(['role:admin,manager'])->group(function () {
        // Stock request routes
        Route::get('/stock-request/create', [StockController::class, 'create'])->name('stock.request.create');
        Route::post('/stock-request', [StockController::class, 'store'])->name('stock.request.store');
        
        // Resource routes
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('products', ProductController::class);
        
        // Stock movement routes
        Route::get('stock', [StockMovementController::class, 'index'])->name('stock.index');
        Route::get('stock/in', [StockMovementController::class, 'createIn'])->name('stock.in.create');
        Route::post('stock/in', [StockMovementController::class, 'storeIn'])->name('stock.in.store');
        Route::get('stock/out', [StockMovementController::class, 'createOut'])->name('stock.out.create');
        Route::post('stock/out', [StockMovementController::class, 'storeOut'])->name('stock.out.store');
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // ===== ROUTES KHUSUS ADMIN =====
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        
        // Admin specific routes
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [DashboardController::class, 'users'])->name('users');
        });
    });

    // ===== ROUTES KHUSUS MANAGER =====
    Route::middleware(['role:manager'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [ManagerController::class, 'users'])->name('users');
    });

    // ===== ROUTES UNTUK SEMUA ROLE =====
    Route::middleware(['role:admin,manager,staff'])->group(function () {
        Route::resource('stock', StockMovementController::class);
        Route::resource('stockopname', App\Http\Controllers\StockOpnameController::class);
    });

    // API Routes for AJAX search
    Route::get('/api/products/search', [ProductController::class, 'search'])->name('products.search');

    // Additional utility routes
    Route::get('/products/{product}/stock-history', [ProductController::class, 'stockHistory'])->name('products.stock-history');
    Route::post('/products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('products.update-stock');

    // Export routes
    Route::get('/products/export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
    Route::get('/products/export/pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');
});

require __DIR__.'/auth.php';