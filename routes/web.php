<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\web\WebController;
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
