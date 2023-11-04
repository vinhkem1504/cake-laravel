<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminControllers\CategoryController;
use App\Http\Controllers\AdminControllers\FlavourController;
use App\Http\Controllers\AdminControllers\SizeController;
use App\Http\Controllers\AdminControllers\MaterialController;
use App\Http\Controllers\AdminControllers\SupplierController;


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

/**
 * Home Routes
 */
Route::get('/', [HomeController::class, 'index'])->name('client-views.home');
Route::get('/user', [HomeController::class, 'showUserInfo'])->name('client-views.user');
Route::post('/products', [HomeController::class, 'getListProducts'])->name('products.get');
Route::post('/categories', [HomeController::class, 'filterCategory'])->name('categories.filter');

Route::group(['middleware' => ['guest']], function () {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
});

Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.perform');
});




Route::get('/admin/dashboard', function () {
    return view('admin-views.dashboard');
});

Route::get('/admin/list', function () {
    return view('admin-views.list');
});

# Admin Category 
Route::get('/admin/category/index', [CategoryController::class, 'index']);
Route::get('/admin/category/', [CategoryController::class, 'index']);
Route::get('/admin/category/add_or_edit', [CategoryController::class, 'add']);
Route::post('/admin/category/add_or_edit', [CategoryController::class, 'insert']);
Route::get('/admin/category/add_or_edit/{id}', [CategoryController::class, 'edit']);
Route::post('/admin/category/add_or_edit/{id}', [CategoryController::class, 'update']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete']);


# Admin Flavour 
Route::get('/admin/flavour/index', [FlavourController::class, 'index']);
Route::get('/admin/flavour/', [FlavourController::class, 'index']);
Route::get('/admin/flavour/add_or_edit', [FlavourController::class, 'add']);
Route::post('/admin/flavour/add_or_edit', [FlavourController::class, 'insert']);
Route::get('/admin/flavour/add_or_edit/{id}', [FlavourController::class, 'edit']);
Route::post('/admin/flavour/add_or_edit/{id}', [FlavourController::class, 'update']);
Route::get('/admin/flavour/delete/{id}', [FlavourController::class, 'delete']);


# Admin Size 
Route::get('/admin/size/index', [SizeController::class, 'index']);
Route::get('/admin/size/', [SizeController::class, 'index']);
Route::get('/admin/size/add_or_edit', [SizeController::class, 'add']);
Route::post('/admin/size/add_or_edit', [SizeController::class, 'insert']);
Route::get('/admin/size/add_or_edit/{id}', [SizeController::class, 'edit']);
Route::post('/admin/size/add_or_edit/{id}', [SizeController::class, 'update']);
Route::get('/admin/size/delete/{id}', [SizeController::class, 'delete']);


# Admin Material
Route::get('/admin/material/index', [MaterialController::class, 'index']);
Route::get('/admin/material/', [MaterialController::class, 'index']);
Route::get('/admin/material/add_or_edit', [MaterialController::class, 'add']);
Route::post('/admin/material/add_or_edit', [MaterialController::class, 'insert']);
Route::get('/admin/material/add_or_edit/{id}', [MaterialController::class, 'edit']);
Route::post('/admin/material/add_or_edit/{id}', [MaterialController::class, 'update']);
Route::get('/admin/material/delete/{id}', [MaterialController::class, 'delete']);


# Admin Supplier
Route::get('/admin/supplier/index', [SupplierController::class, 'index']);
Route::get('/admin/supplier/', [SupplierController::class, 'index']);
Route::get('/admin/supplier/add_or_edit', [SupplierController::class, 'add']);
Route::post('/admin/supplier/add_or_edit', [SupplierController::class, 'insert']);
Route::get('/admin/supplier/add_or_edit/{id}', [SupplierController::class, 'edit']);
Route::post('/admin/supplier/add_or_edit/{id}', [SupplierController::class, 'update']);
Route::get('/admin/supplier/delete/{id}', [SupplierController::class, 'delete']);