<?php

use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

// ...existing code...

// Маршруты для управления контактами
Route::resource('contacts', ContactController::class)
    ->except(['create', 'store', 'show', 'destroy']);

// ...existing code...
