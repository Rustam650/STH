<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;  // Добавляем этот импорт
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\StoneTypeController as AdminStoneTypeController;
use App\Models\Portfolio;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\StoneTypeController;
use Illuminate\Support\Facades\Auth;

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
// Remove this duplicate route
// Route::get('/stone-types', [App\Http\Controllers\StoneTypeController::class, 'index'])->name('stone-types.index');
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index'])->name('services');
Route::get('/portfolio', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolio');
Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Replace this line
Route::get('/stone-types', [StoneTypeController::class, 'index'])->name('stone-types');

// Маршруты аутентификации и профиля
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Маршруты для админ-панели
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Ресурсные маршруты для секций главной страницы
    Route::resource('home_sections', HomeSectionController::class);
    Route::post('home_sections/reorder', [HomeSectionController::class, 'reorder'])->name('home_sections.reorder');
    
    // Маршруты для контактов
    Route::resource('contacts', ContactController::class);
    
    Route::resource('stone-types', AdminStoneTypeController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class);
});

// Добавим маршрут для API в web.php вместо api.php
Route::get('/api/portfolio/{id}', function ($id) {
    $portfolio = Portfolio::with('images')->findOrFail($id);
    return response()->json([
        'id' => $portfolio->id,
        'title' => $portfolio->title,
        'description' => $portfolio->description,
        'category' => $portfolio->category,
        'images' => $portfolio->images->pluck('image')
    ]);
});

require __DIR__.'/auth.php';