<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
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
Route::post('/products', [HomeController::class, 'getListProducts'])->name('products.get');
Route::post('/categories', [HomeController::class, 'filterCategory'])->name('categories.filter');
Route::get('/product_id={product_id}', [ProductController::class, 'index'])->name('client-views.productDetails');
Route::get('/getSize_{product_id}', [ProductController::class, 'getSize'])->name('productDetails.getSize');
Route::post('/productDetails', [ProductController::class, 'getProductDetails'])->name('productDetails.option');
Route::get('/ratingOf_{product_id}', [ProductController::class, 'getRating'])->name('rating.get');
Route::post('/createRate', [ProductController::class, 'createRating'])->name('rating.create');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addProductToCart']);
Route::post('/cart/addOneProduct', [CartController::class, 'addOneProductFromCart']);
Route::delete('/cart/deleteOneProduct', [CartController::class, 'deleteOneProductFromCart']);
Route::delete('/cart/deleteOneTypeProduct', [CartController::class, 'deleteOneTypeProductFromCart']);


Route::get('/shop', [ProductController::class, 'showAllProduct'])->name('shop.show');
Route::post('/paginationShop', [ProductController::class, 'getAllProduct'])->name('shop.getAll');
Route::post('/search_filter_shop', [ProductController::class, 'filterCategoryShop'])->name('shop.search');

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


// user phai login moi truy cap duoc cac link sau
Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.perform');

    Route::get('/user', [HomeController::class, 'showUserInfo'])->name('client-views.user');

    Route::get('/info', [UserController::class, 'getUser'])->name('get-user');
    Route::post('/info', [UserController::class, 'updateUser'])->name('update-user');

    Route::get('/user', [HomeController::class, 'showUserInfo'])->name('client-views.user');

    Route::get('/info', [UserController::class, 'getUser'])->name('get-user');
    Route::post('/info', [UserController::class, 'updateUser'])->name('update-user');

    Route::get('/user/bills', [UserController::class, 'getUserBill'])->name('client-views.bills');
    Route::get('/user/bills/{billId}', [UserController::class, 'getDetailsBill'])->name('user.bill-details');
    Route::put('/user/bills/cancel', [UserController::class, 'cancelBill'])->name('user.cancel-bill');
    Route::get('/bill/all', [UserController::class, 'getUserBill'])->name('get-all-userBill');
    // Route::post('')
    Route::get('/cart/get-products', [UserController::class, 'getProductsFromCart'])->name('user.get-cart');
    Route::get('/checkout', [UserController::class, 'showCheckoutCart'])->name('show.checkoutCart');
    Route::post('/checkout', [UserController::class, 'createUserBill'])->name('create.bill');
});
