<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\web\WebController;
use App\Http\Controllers\v1\dashboard\PanierController;
use App\Http\Controllers\v1\dashboard\MagasinController;
use App\Http\Controllers\v1\dashboard\ProductController;
use App\Http\Controllers\v1\dashboard\CategoryController;
use App\Http\Controllers\v1\dashboard\CommandeController;
use App\Http\Controllers\v1\dashboard\Auth\AuthController;
use App\Http\Controllers\v1\dashboard\DashboardController;
use App\Http\Controllers\v1\dashboard\ProductCategoryController;

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



Route::group(['as' => 'web.'], function () {
    Route::get('/', [WebController::class, 'home'])->name('home');
    Route::get('/products', [WebController::class, 'products'])->name('products');
    Route::post('/panier/ajouter', [PanierController::class, 'add'])->name('panier.add');
    // Route::get('/products/add-to-cart', [WebController::class, 'AddToCart'])->name('add.to.cart');
    Route::get('/products/{slug}', [WebController::class, 'product'])->name('product');
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/client-login', [AuthController::class, 'getWebLogin'])->name('login.get');
        Route::post('/client-register', [AuthController::class, 'register'])->name('register.post');
    });
});

// Auth Systeme
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login.get');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'app.', 'prefix' => 'app', 'middleware' => ['auth'], "hasRole:admin"], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dash');

    Route::resources([
        'products' => ProductController::class,
        'magasins' => MagasinController::class,
        'categories' => CategoryController::class,
        'commands' => CommandeController::class,
        'types' => ProductCategoryController::class,
    ]);
    Route::get('/commands/is-valid-toggle/{id}', [CommandeController::class, 'isValidToggle'])->name('commands.is.valid.toggle');
});
