<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\web\WebController;
use App\Http\Controllers\v1\dashboard\ProductController;
use App\Http\Controllers\v1\dashboard\DashboardController;

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



Route::group(['as' => 'app.', 'prefix' => 'app'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dash');

    Route::resources([
        'products' => ProductController::class,
        // 'magasins' => MagasinController::class,
        // 'categories' => CategoryController::class,

    ]);
});
