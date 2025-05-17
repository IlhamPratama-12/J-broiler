<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

Route::get('/',                 [MainController::class, 'home'])->name('main.home');
Route::post('/',                [MainController::class, 'guestCreate'])->name('main.guest.create');;
Route::get('/products',         [MainController::class, 'products'])->name('main.products');
Route::get('/products/{slug}',  [MainController::class, 'productDetail'])->name('main.products.detail');
Route::get('/contact',          [MainController::class, 'contact']);
Route::get('/partnership',      [MainController::class, 'partnership']);
Route::get('/about',            [MainController::class, 'about']);

Route::prefix('admin')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'index')->middleware('guest');
        Route::post('/', 'login')->middleware('guest')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard',                                        DashboardController::class)->name('dashboard');
        Route::post('guests/{guest}/partnership',                       [GuestController::class, 'addPartnership'])->name('guests.add-partnership');
        Route::post('products/{product}/is-visible',                    [ProductController::class, 'isVisible'])->name('products.isvisible');
        Route::post('product-categories/{productCategory}/is-visible',  [ProductCategoryController::class, 'isVisible'])->name('category.isvisible');


        Route::resource('product-categories',   ProductCategoryController::class);
        Route::resource('products',             ProductController::class);
        Route::resource('guests',               GuestController::class);
        Route::resource('partnerships',         PartnershipController::class);
        Route::resource('expense-types',        ExpenseTypeController::class);
        Route::resource('expenses',             ExpenseController::class);

        Route::get('sales/{sale}/print',        [SaleController::class, 'print'])->name('sale.print');
        Route::post('sales/{sale}/cancel',      [SaleController::class, 'cancel'])->name('sale.cancel');
        Route::post('sales/{sale}/is-active',   [SaleController::class, 'isActive'])->name('sale.is-active');
        Route::get('sales/pending',             [SaleController::class, 'listPending'])->name('sales.pending');
        Route::resource('sales',                SaleController::class);

        Route::get('reports/product/print',     [ReportController::class, 'productReportPrint'])->name('report.product.print');
        Route::get('reports/product',           [ReportController::class, 'productReport'])->name('report.product');
        Route::get('reports/statistic',         [StatisticController::class, 'statisticReport'])->name('report.statistic');

    });
});
