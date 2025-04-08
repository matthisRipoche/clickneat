<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\HomeManagerController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', [EntryController::class, 'index'])->name('entry.index');

    Route::middleware('role:user')->group(function () {
        Route::get('/user', [HomeUserController::class, 'index'])->name('home_user.index');
        Route::get('/user/restaurants-{id}', [HomeUserController::class, 'restaurantchoosen'])->name('home_user.restaurantchoosen');
        Route::get('/user/cart', [HomeUserController::class, 'cart'])->name('home_user.cart');
    });


    Route::middleware('role:manager')->group(function () {
        Route::get('/manager', [HomeManagerController::class, 'index'])->name('home_manager.index');
        Route::get('/manager/createRestaurant', [HomeManagerController::class, 'createRestaurant'])->name('home_manager.createRestaurant');
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
