<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Front\OrderPdfController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FaqController;

use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// // Route de test
// Route::get('/test-checkout', function() {
//     return view('front.orders.checkout', [
//         'cartItems' => collect(),
//         'total' => 0
//     ]);
// });

// Route::get('/test-checkout-simple', [TestController::class, 'checkoutTest']);


// Pages publiques
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Panier
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

// Commandes - CES ROUTES DOIVENT ÊTRE APRÈS LES AUTRES
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/confirmation/{order}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');


// Routes Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Produits
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
        Route::patch('/products/{product}/status', [AdminProductController::class, 'updateStatus'])->name('products.update-status');

        // Commandes
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

        // Catégories
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::patch('/categories/{category}/status', [AdminCategoryController::class, 'updateStatus'])->name('categories.update-status');

        // Bannières
        Route::get('/banners', [AdminBannerController::class, 'index'])->name('banners.index');
        Route::get('/banners/create', [AdminBannerController::class, 'create'])->name('banners.create');
        Route::post('/banners', [AdminBannerController::class, 'store'])->name('banners.store');
        Route::get('/banners/{banner}/edit', [AdminBannerController::class, 'edit'])->name('banners.edit');
        Route::put('/banners/{banner}', [AdminBannerController::class, 'update'])->name('banners.update');
        Route::delete('/banners/{banner}', [AdminBannerController::class, 'destroy'])->name('banners.destroy');
        Route::patch('/banners/{banner}/status', [AdminBannerController::class, 'updateStatus'])->name('banners.update-status');
        Route::post('/banners/reorder', [AdminBannerController::class, 'reorder'])->name('banners.reorder');

        // Profil admin
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        // FAQ Admin Routes
        Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::get('/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
        Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
        Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    });
});

// PDF des commandes
Route::get('/orders/{order}/pdf/download', [OrderPdfController::class, 'download'])->name('orders.pdf.download');
Route::get('/orders/{order}/pdf/view', [OrderPdfController::class, 'view'])->name('orders.pdf.view');
