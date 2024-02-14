<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

//category view  //index show
Route::get('/view_category', [AdminController::class, 'view_category'])->name('view_category');
//category_add
Route::post('/add_category', [AdminController::class, 'add_category'])->name('add_category');
//edit_category
// Route::get('/edit_category/{id}', [AdminController::class, 'edit_category'])->name('edit_category');
Route::get('/edit_category/{id}', [AdminController::class, 'edit_category'])->name('edit_category');
//delete_category
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category'])->name('delete_category');
//update_category
Route::post('/update_category', [AdminController::class, 'update_category'])->name('update_category');

// products apis  showindex
Route::get('/view_product', [AdminController::class, 'view_product'])->name('view_product');

Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product');

//show_product  //full product listing
Route::get('/show_product', [AdminController::class, 'show_product'])->name('show_product');

//edit_product
Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->name('update_product');

//delete_product 
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product'])->name('delete_product');

//edit then update
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');


//home apis
Route::get('/product_detail/{id}', [HomeController::class, 'product_detail'])->name('product_detail');

//add_cart
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');

//show_cart
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');

//remove_cart
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');


//cash on delivary api
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
