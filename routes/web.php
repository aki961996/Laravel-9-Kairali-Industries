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

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

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

//admin order
Route::get('/view_order', [AdminController::class, 'view_order'])->name('view_order');

//admin users api
//view_users
Route::get('/view_users', [AdminController::class, 'view_users'])->name('view_users');

 Route::get('/search_users', [AdminController::class, 'search_users'])->name('search_users');


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

//stripe
Route::get('/charge_stripe', [HomeController::class, 'charge_stripe'])->name('charge_stripe');

Route::post('/session', [HomeController::class, 'checkout'])->name('session');

Route::get('/success', [HomeController::class, 'success'])->name('success');
//stripe api end

//delivered
Route::get('/delivered{id}', [AdminController::class, 'delivered'])->name('delivered');

//print_pdf
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf'])->name('print_pdf');

//send_email
Route::get('/send_email/{id}', [AdminController::class, 'send_email'])->name('send_email');

//send_user_email
Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email'])->name('send_user_email');

//search
Route::get('/search', [AdminController::class, 'search'])->name('search');

//show_order order tab in home home controlelr 
Route::get('/show_order', [HomeController::class, 'show_order'])->name('show_order');

//remove_order
Route::get('/remove_order/{id}', [HomeController::class, 'remove_order'])->name('remove_order');

// //comment side in home
// Route::post('/comment_add', [HomeController::class, 'comment_add'])->name('comment_add');


// //reply_comment
// Route::post('/add_reply', [HomeController::class, 'add_reply'])->name('add_reply');


//search_products we can search for api all products
Route::get('/product_search', [HomeController::class, 'product_search'])->name('product_search');

//products
Route::get('/products', [HomeController::class, 'products']);

//search_product indugul product page
//search
Route::get('/search_product', [HomeController::class, 'search_product'])->name('search_product');

//contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//post
Route::post('/contact_us', [HomeController::class, 'store'])->name('contact_us');
