<?php

use App\Http\Controllers\AdminControllers\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminControllers\CategoryController;
use App\Http\Controllers\AdminControllers\FlavourController;
use App\Http\Controllers\AdminControllers\SizeController;
use App\Http\Controllers\AdminControllers\MaterialController;
use App\Http\Controllers\AdminControllers\SupplierController;
use App\Http\Controllers\AdminControllers\ImportBillController;
use App\Http\Controllers\AdminControllers\DetailsImportBillController;
use App\Http\Controllers\AdminControllers\BillController;
use App\Http\Controllers\AdminControllers\HomeAdminController;
use App\Http\Controllers\AdminControllers\ProductDetailsController;
use App\Http\Controllers\AdminControllers\UserAdminController;
use App\Http\Controllers\AdminControllers\ProductAdminController;


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

    // pusher
    Route::post('/pusher/auth', [UserController::class, 'pusherAuth']);
});

Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin-views.login');
    Route::post('/admin/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
});

Route::group(['middleware' => 'admin.auth'], function () {

    Route::get('/admin/dashboard', [HomeAdminController::class, 'index'])->name('admin-views.dashboard');

    Route::get('/admin/logout', [HomeAdminController::class, 'logout'])->name('admin-views.logout');





    # Admin Category 
    Route::get('/admin/category/index', [CategoryController::class, 'index']);
    Route::get('/admin/category/', [CategoryController::class, 'index']);
    Route::get('/admin/category/add', [CategoryController::class, 'add']);
    Route::post('/admin/category/add', [CategoryController::class, 'insert']);
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete']);


    # Admin Flavour 
    Route::get('/admin/flavour/index', [FlavourController::class, 'index']);
    Route::get('/admin/flavour/', [FlavourController::class, 'index']);
    Route::get('/admin/flavour/add', [FlavourController::class, 'add']);
    Route::post('/admin/flavour/add', [FlavourController::class, 'insert']);
    Route::get('/admin/flavour/edit/{id}', [FlavourController::class, 'edit']);
    Route::post('/admin/flavour/edit/{id}', [FlavourController::class, 'update']);
    Route::get('/admin/flavour/delete/{id}', [FlavourController::class, 'delete']);


    # Admin Size 
    Route::get('/admin/size/index', [SizeController::class, 'index']);
    Route::get('/admin/size/', [SizeController::class, 'index']);
    Route::get('/admin/size/add', [SizeController::class, 'add']);
    Route::post('/admin/size/add', [SizeController::class, 'insert']);
    Route::get('/admin/size/edit/{id}', [SizeController::class, 'edit']);
    Route::post('/admin/size/edit/{id}', [SizeController::class, 'update']);
    Route::get('/admin/size/delete/{id}', [SizeController::class, 'delete']);


    # Admin Material
    Route::get('/admin/material/index', [MaterialController::class, 'index']);
    Route::get('/admin/material/', [MaterialController::class, 'index']);
    Route::get('/admin/material/add', [MaterialController::class, 'add']);
    Route::post('/admin/material/add', [MaterialController::class, 'insert']);
    Route::get('/admin/material/edit/{id}', [MaterialController::class, 'edit']);
    Route::post('/admin/material/edit/{id}', [MaterialController::class, 'update']);
    Route::get('/admin/material/delete/{id}', [MaterialController::class, 'delete']);


    # Admin Supplier
    Route::get('/admin/supplier/index', [SupplierController::class, 'index']);
    Route::get('/admin/supplier/', [SupplierController::class, 'index']);
    Route::get('/admin/supplier/add', [SupplierController::class, 'add']);
    Route::post('/admin/supplier/add', [SupplierController::class, 'insert']);
    Route::get('/admin/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::post('/admin/supplier/edit/{id}', [SupplierController::class, 'update']);
    Route::get('/admin/supplier/delete/{id}', [SupplierController::class, 'delete']);


    # Admin Import Bill
    Route::get('/admin/import_bill/index', [ImportBillController::class, 'index']);
    Route::get('/admin/import_bill/', [ImportBillController::class, 'index']);
    Route::get('/admin/import_bill/add', [ImportBillController::class, 'add']);
    Route::post('/admin/import_bill/add', [ImportBillController::class, 'insert']);
    Route::get('/admin/import_bill/edit/{id}', [ImportBillController::class, 'edit']);
    Route::post('/admin/import_bill/edit/{id}', [ImportBillController::class, 'update']);
    Route::get('/admin/import_bill/delete/{id}', [ImportBillController::class, 'delete']);


    # Admin Import Bill Details
    Route::get('/admin/details_import_bill/add/{import_bill_id}', [DetailsImportBillController::class, 'add']);
    Route::post('/admin/details_import_bill/add/{import_bill_id}', [DetailsImportBillController::class, 'insert']);
    Route::get('/admin/details_import_bill/edit/{id}', [DetailsImportBillController::class, 'edit']);
    Route::post('/admin/details_import_bill/edit/{id}', [DetailsImportBillController::class, 'update']);
    Route::get('/admin/details_import_bill/delete/{id}', [DetailsImportBillController::class, 'delete']);

    # Admin Bill
    Route::get('/admin/bill/index', [BillController::class, 'index']);
    Route::get('/admin/bill/', [BillController::class, 'index']);
    Route::get('/admin/bill/{id}', [BillController::class, 'detail']);
    Route::post('/admin/bill/{bill_id}', [BillController::class, 'update_status']);

    # Admin Product
    Route::get('/admin/product/index', [ProductAdminController::class, 'index']);
    Route::get('/admin/product/', [ProductAdminController::class, 'index']);
    Route::get('/admin/product/add', [ProductAdminController::class, 'add']);
    Route::post('/admin/product/add', [ProductAdminController::class, 'insert']);
    Route::get('/admin/product/edit/{id}', [ProductAdminController::class, 'edit']);
    Route::post('/admin/product/edit/{id}', [ProductAdminController::class, 'update']);
    Route::get('/admin/product/delete/{id}', [ProductAdminController::class, 'delete']);

    # Admin Product Detail
    Route::get('/admin/product_details/index/{product_id}', [ProductDetailsController::class, 'index']);
    Route::get('/admin/product_details/add/{product_id}', [ProductDetailsController::class, 'add']);
    Route::post('/admin/product_details/add/{product_id}', [ProductDetailsController::class, 'insert']);
    Route::get('/admin/product_details/edit/{id}', [ProductDetailsController::class, 'edit']);
    Route::post('/admin/product_details/edit/{id}', [ProductDetailsController::class, 'update']);
    Route::get('/admin/product_details/delete/{id}', [ProductDetailsController::class, 'delete']);

    # Admin user list
    Route::get('/admin/user/index/', [UserAdminController::class, 'index']);
    Route::get('/admin/user/', [UserAdminController::class, 'index']);



    // thong ke
    

});
Route::get('/admin/getBillCountByDateAndStatus/', [BillController::class, 'getBillCountByDateAndStatus']);