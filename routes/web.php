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

//category view
Route::get('/view_category', [AdminController::class, 'view_category'])->name('view_category');
//category_add
Route::post('/add_category', [AdminController::class, 'add_category'])->name('add_category');

//edit_category
Route::get('/edit_category{id}', [AdminController::class, 'edit_category'])->name('edit_category');

//delete_category
Route::get('/delete_category{id}', [AdminController::class, 'delete_category'])->name('delete_category');

//update_category

Route::post('/update_category', [AdminController::class, 'update_category'])->name('update_category');
