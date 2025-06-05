<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntryController;

use App\Http\Controllers\user\HomeUserController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\StripeCheckoutController;

use App\Http\Controllers\manager\HomeManagerController;
use App\Http\Controllers\manager\ManagerCategoryController;
use App\Http\Controllers\manager\ManagerItemController;
use App\Http\Controllers\manager\ManagerOrderController;

use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\RestaurantController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ItemController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', [EntryController::class, 'checkRole'])->name('entry.index');

    Route::middleware('role:user')->group(function () {
        Route::get('/user', [HomeUserController::class, 'index'])->name('home_user.index');
        Route::get('/user/restaurants-{id}', [HomeUserController::class, 'restaurantchoosen'])->name('home_user.restaurantchoosen');
        Route::get('/user/cart', [HomeUserController::class, 'cart'])->name('home_user.cart');


        Route::post('/cart/add', [CartController::class, 'addItemToCart'])->name('cart.addItemToCart');
        Route::delete('/cart/remove/{id}', [CartController::class, 'removeItemFromCart'])->name('cart.removeItemFromCart');
        Route::put('/cart/increment/{id}', [CartController::class, 'incrementQuantity'])->name('cart.incrementQuantity');
        Route::put('/cart/decrement/{id}', [CartController::class, 'decrementQuantity'])->name('cart.decrementQuantity');
        Route::delete('/cart/reset', [CartController::class, 'resetCart'])->name('cart.reset');
        Route::post('/cart/checkout', [CartController::class, 'CartToOrder'])->name('cart.checkout');

        Route::post('/user/cart/create-checkout-session', [StripeCheckoutController::class, 'createCheckoutSession']);
        Route::get('/checkout/success', [StripeCheckoutController::class, 'success'])->name('cart.checkout.success');
        Route::get('/checkout/cancel', [StripeCheckoutController::class, 'cancel'])->name('cart.checkout.cancel');
    });

    Route::middleware('role:manager')->group(function () {
        Route::get('/manager', [HomeManagerController::class, 'index'])->name('manager.index');
        Route::get('/manager/createRestaurant', [HomeManagerController::class, 'createRestaurant'])->name('manager.createRestaurant');
        Route::post('/manager/createRestaurant', [HomeManagerController::class, 'storeRestaurant'])->name('manager.storeRestaurant');

        //route pour Category
        Route::get('/manager/categories', [ManagerCategoryController::class, 'index'])->name('manager.categories.index');
        Route::get('/manager/categories/{id}/show', [ManagerCategoryController::class, 'show'])->name('manager.categories.show');
        Route::get('/manager/categories/create', [ManagerCategoryController::class, 'create'])->name('manager.categories.create');
        Route::post('/manager/categories', [ManagerCategoryController::class, 'store'])->name('manager.categories.store');
        Route::get('/manager/categories/{id}/edit', [ManagerCategoryController::class, 'edit'])->name('manager.categories.edit');
        Route::put('/manager/categories/{id}/update', [ManagerCategoryController::class, 'update'])->name('manager.categories.update');
        Route::delete('/manager/categories/{id}/destroy', [ManagerCategoryController::class, 'destroy'])->name('manager.categories.destroy');

        //route pour Item
        Route::get('/manager/items', [ManagerItemController::class, 'index'])->name('manager.items.index');
        Route::get('/manager/items/{id}/show', [ManagerItemController::class, 'show'])->name('manager.items.show');
        Route::get('/manager/items/create', [ManagerItemController::class, 'create'])->name('manager.items.create');
        Route::post('/manager/items', [ManagerItemController::class, 'store'])->name('manager.items.store');
        Route::get('/manager/items/{id}/edit', [ManagerItemController::class, 'edit'])->name('manager.items.edit');
        Route::put('/manager/items/{id}/update', [ManagerItemController::class, 'update'])->name('manager.items.update');
        Route::delete('/manager/items/{id}/destroy', [ManagerItemController::class, 'destroy'])->name('manager.items.destroy');

        //route pour Commandes
        Route::get('/manager/commandes', [ManagerOrderController::class, 'index'])->name('manager.commandes.index');
        Route::get('/manager/commandes/{id}/show', [ManagerOrderController::class, 'show'])->name('manager.commandes.show');
        Route::get('/manager/commandes/create', [ManagerOrderController::class, 'create'])->name('manager.commandes.create');
        Route::post('/manager/commandes', [ManagerOrderController::class, 'store'])->name('manager.commandes.store');
        Route::get('/manager/commandes/{id}/edit', [ManagerOrderController::class, 'edit'])->name('manager.commandes.edit');
        Route::put('/manager/commandes/{id}/update', [ManagerOrderController::class, 'update'])->name('manager.commandes.update');
        Route::delete('/manager/commandes/{id}/destroy', [ManagerOrderController::class, 'destroy'])->name('manager.commandes.destroy');
    });

    Route::middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        //route pour User
        Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/dashboard/users/{id}/show', [UserController::class, 'show'])->name('users.show');

        //route pour Restaurant
        Route::get('/dashboard/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
        Route::get('/dashboard/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');
        Route::get('/dashboard/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
        Route::post('/dashboard/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
        Route::get('/dashboard/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
        Route::put('/dashboard/restaurants/{id}/update', [RestaurantController::class, 'update'])->name('restaurants.update');
        Route::delete('/dashboard/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

        //route pour Category
        Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/dashboard/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/dashboard/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/dashboard/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/dashboard/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

        //route pour Item
        Route::get('/dashboard/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/dashboard/items/{id}/show', [ItemController::class, 'show'])->name('items.show');
        Route::get('/dashboard/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/dashboard/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/dashboard/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/dashboard/items/{id}/update', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/dashboard/items/{id}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');

        //route pour les commandes
        Route::get('/dashboard/commandes', [OrderController::class, 'index'])->name('commandes.index');
        Route::get('/dashboard/commandes/{id}/show', [OrderController::class, 'show'])->name('commandes.show');
        Route::get('/dashboard/commandes/create', [OrderController::class, 'create'])->name('commandes.create');

        //route pour Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
