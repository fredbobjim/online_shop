<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyOptionController;
use App\Http\Controllers\Admin\SkuController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Person\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/locale/{locale}', [MainController::class, 'changeLocale'])->name('locale');

Route::middleware(['set_locale'])->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

    Route::middleware(['guest'])->group(function () {
        Route::controller(RegisteredUserController::class)->group(function () {
            Route::get('/register', 'create')->name('register');
            Route::post('/register', 'store');
        });

        Route::controller(AuthenticatedSessionController::class)->group(function () {
            Route::get('/login', 'create')->name('login');
            Route::post('/login', 'store');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(OrderController::class)
            ->prefix('person')->group(function () {
                Route::get('/orders', 'index')->name('person.orders.index');
                Route::get('/orders/{order}', 'order')->name('person.orders.show');
        });

        Route::group([
            'prefix' => 'admin'
        ], function () {
            Route::resources([
                'categories' => CategoryController::class,
                'products' => ProductController::class,
                'products/{product}/skus' => SkuController::class,
                'properties' => PropertyController::class,
                'properties/{property}/property-options' => PropertyOptionController::class
            ]);

            Route::controller(OrdersController::class)->group(function () {
                Route::get('/orders', 'index')->name('orders');
                Route::get('/orders/{order}', 'order')->name('order');
            });
        });
    });

    Route::controller(MainController::class)->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/categories', 'categories')->name('categories');
        Route::get('/store/{category}', 'category')->name('category');
        Route::get('/store/{category}/{product}/{sku}', 'sku')->name('sku');
    });

    Route::group(['prefix' => 'basket'], function () {
        Route::post('/add/{sku}', [BasketController::class, 'basketAdd'])->name('basket-add');

        Route::controller(BasketController::class)
            ->middleware('basket_not_empty')
            ->group(function () {
                Route::get('/', 'basket')->name('basket');
                Route::post('/remove/{sku}', 'basketRemove')->name('basket-remove');
                Route::get('/order', 'order')->name('basket-order');
                Route::post('/order', 'orderConfirm')->name('basket-confirm');
            });
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});

require __DIR__.'/auth.php';
