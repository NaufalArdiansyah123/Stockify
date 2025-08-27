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
use App\Http\Controllers\StockOpnameController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard (global)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Stock Management
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    // Barang masuk / keluar
    Route::get('stock', [StockMovementController::class, 'index'])->name('stock.index');
    Route::get('stock/in', [StockMovementController::class, 'createIn'])->name('stock.in.create');
    Route::post('stock/in', [StockMovementController::class, 'storeIn'])->name('stock.in.store');
    Route::get('stock/out', [StockMovementController::class, 'createOut'])->name('stock.out.create');
    Route::post('stock/out', [StockMovementController::class, 'storeOut'])->name('stock.out.store');

    // Request stock
    Route::get('/stock-request/create', [StockController::class, 'create'])->name('stock.request.create');
    Route::post('/stock-request', [StockController::class, 'store'])->name('stock.request.store');
});

// Resource stock (otomatis bikin stock.create, stock.store, dst)
Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {
    Route::resource('stock', StockMovementController::class);
});

/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| Users (admin only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

/*
|--------------------------------------------------------------------------
| Stock Opname
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:manager,admin,staff'])->group(function () {
    Route::resource('stockopname', StockOpnameController::class);
});

/*
|--------------------------------------------------------------------------
| Role-specific dashboards
|--------------------------------------------------------------------------
*/
// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
});

// Manager
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [ManagerController::class, 'users'])->name('users');
});

// Staff
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [StaffController::class, 'tasks'])->name('tasks');

    // Konfirmasi stok
    Route::post('/confirm/{id}', [StaffController::class, 'confirm'])->name('confirm');
});

/*
|--------------------------------------------------------------------------
| Products / Categories / Suppliers
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);

// Extra product utilities
Route::get('/api/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}/stock-history', [ProductController::class, 'stockHistory'])->name('products.stock-history');
Route::post('/products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('products.update-stock');

// Export
Route::get('/products/export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
Route::get('/products/export/pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');

/*
|--------------------------------------------------------------------------
| Root redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'manager') {
            return redirect()->route('manager.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return redirect('/login');
});

require __DIR__.'/auth.php';
