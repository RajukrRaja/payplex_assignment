<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\PageController as UserPageController;
use App\Http\Middleware\RoleMiddleware;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (Role-based redirection)
Route::get('/dashboard', [AuthController::class, 'redirectBasedOnRole'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

// Authentication
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::group([
    'middleware' => [RoleMiddleware::class . ':admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pages', AdminPageController::class);
    Route::post('pages/{page}/toggle', [AdminPageController::class, 'toggleStatus'])->name('pages.toggle');
});

// User Routes
Route::group([
    'middleware' => [RoleMiddleware::class . ':user'],
    'prefix' => 'user',
    'as' => 'user.'
], function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('page/{id}', [UserPageController::class, 'show'])->name('page.show');
});

// Dynamic Routes
try {
    $pages = App\Models\Page::where('status', true)->orderBy('id')->get();
    foreach ($pages as $index => $page) {
        Route::get('/home' . ($index + 1), [UserPageController::class, 'show'])
            ->defaults('id', $page->id)
            ->name('home' . ($index + 1));
    }
} catch (\Exception $e) {
    \Log::error('Failed to generate dynamic routes: ' . $e->getMessage());
}
Route::get('/home' . ($index + 1), [UserPageController::class, 'show'])
    ->defaults('id', $page->id)
    ->name('home' . ($index + 1));