<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/showLogin', [AuthController::class, 'showLogin'])->name('login');
Route::get('/showRegister', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login-post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register-post');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/dashboard', function () {
    return view('admins.dashboard');
})->name('admins.dashboard')->middleware(['auth', 'admin']);

Route::prefix('admins')->middleware(['auth', 'admin'])->name('admins.')->group(function () {
    Route::get('/products', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('products')->name('products.')->group(function (): void {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [ProductController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('categories')->name('categories.')->group(function (): void {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/{id}/show', [CategoryController::class, 'show'])->name('show');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [CategoryController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [CategoryController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('banners')->name('banners.')->group(function (): void {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/{id}/show', [BannerController::class, 'show'])->name('show');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [BannerController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [BannerController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [BannerController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('customers')->name('customers.')->group(function (): void {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{id}/show', [CustomerController::class, 'show'])->name('show');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/store', [CustomerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CustomerController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [CustomerController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [CustomerController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [CustomerController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('contacts')->name('contacts.')->group(function (): void {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ContactController::class, 'show'])->name('show');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ContactController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ContactController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [ContactController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [ContactController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [ContactController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('posts')->name('posts.')->group(function (): void {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [PostController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [PostController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [PostController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('reviews')->name('reviews.')->group(function (): void {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ReviewController::class, 'show'])->name('show');
        Route::get('/create', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReviewController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ReviewController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
        Route::get('/thungrac', [ReviewController::class, 'thungrac'])->name('thungrac');
        Route::put('/{id}/restore', [ReviewController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete', [ReviewController::class, 'forceDelete'])->name('forceDelete');
    });
});


Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::prefix('products')->name('products.')->group(function (): void {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/{id}/show', [HomeController::class, 'show'])->name('show');
        Route::get('/create', [HomeController::class, 'create'])->name('create');
        Route::post('/{id}/store', [HomeController::class, 'store'])->name('store');
    });
    Route::get('/posts', [HomeController::class, 'post'])->name('post');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
});







