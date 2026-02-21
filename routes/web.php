<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin;


Route::get('/', HomeController::class)->name('home');

Route::get('/xidmetler', [ServiceController::class, 'index'])->name('services.index');
Route::get('/xidmetler/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::post('/sifaris', [OrderController::class, 'store'])->name('order.store');

Route::get('/haqqimizda', App\Http\Controllers\AboutController::class)->name('about');
Route::get('/portfolio', App\Http\Controllers\PortfolioController::class)->name('portfolio');
Route::view('/elaqe', 'pages.contact')->name('contact');

// Admin auth (guest only)
Route::get('/admin/login', [Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// Admin protected area
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('dashboard');
    Route::post('services/{service}/duplicate', [Admin\ServiceController::class, 'duplicate'])->name('services.duplicate');
    Route::resource('services', Admin\ServiceController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::put('orders/{order}/status', [Admin\OrderController::class, 'updateStatus'])->name('orders.status');
    Route::resource('portfolio', Admin\PortfolioController::class)->except(['show']);
    Route::resource('team', Admin\TeamMemberController::class)->except(['show'])->parameters(['team' => 'team']);
    Route::resource('testimonials', Admin\TestimonialController::class)->except(['show']);
    Route::resource('faqs', Admin\FaqController::class)->except(['show']);
    Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    Route::get('pages/hero', [Admin\PageController::class, 'heroEdit'])->name('pages.hero');
    Route::put('pages/hero', [Admin\PageController::class, 'heroUpdate'])->name('pages.hero.update');
    Route::get('pages/home', [Admin\PageController::class, 'homeEdit'])->name('pages.home');
    Route::put('pages/home', [Admin\PageController::class, 'homeUpdate'])->name('pages.home.update');
    Route::get('pages/about', [Admin\PageController::class, 'aboutEdit'])->name('pages.about');
    Route::put('pages/about', [Admin\PageController::class, 'aboutUpdate'])->name('pages.about.update');
    Route::get('pages/contact', [Admin\PageController::class, 'contactEdit'])->name('pages.contact');
    Route::put('pages/contact', [Admin\PageController::class, 'contactUpdate'])->name('pages.contact.update');
});
