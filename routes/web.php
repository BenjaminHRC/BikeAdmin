<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
}); //->middleware(['auth'])->name('dashboard');

// *** USERS ***
Route::get('/users', function () {
    return view('admin.users');
});
Route::get('/indexUser', [UserController::class, 'index']);
Route::post('/saveUser', [UserController::class, 'save']);
Route::get('/listUser', [UserController::class, 'list']);
Route::get('/viewUser/{id}', [UserController::class, 'view']);
Route::post('/deleteUser/{id}', [UserController::class, 'delete']);
// *** CONNECTION ***
Route::get('/connexion', function () {
    return view('connexion');
})->name('connexion');
Route::post('/loginConnexion', [UserController::class, 'connect']);
// *** PORDUCTS ***
Route::get('/products', function () {
    return view('production.products'); // return non obligatoire
});
Route::get('indexProduct', [ProductController::class, 'index']);
Route::get('listProduct', [ProductController::class, 'list']);
Route::post('saveProduct', [ProductController::class, 'save']);
Route::post('deleteProduct/{id}', [ProductController::class, 'delete']);
Route::get('viewProduct/{id}', [ProductController::class, 'view']);
Route::get('topProduct', [ProductController::class, 'getTopProducts']);
Route::get('nbProduct', [ProductController::class, 'getNbProducts']);
// *** STOCKS ***
Route::get('/stocks', function () {
    return view('production.stocks');
});
Route::get('indexStock', [StockController::class, 'index']);
Route::get('listStock', [StockController::class, 'list']);
Route::post('saveStock', [StockController::class, 'save']);
Route::post('deleteStock/{store_id}/{product_id}', [StockController::class, 'delete']);
Route::get('viewStock/{store_id}/{product_id}', [StockController::class, 'view']);
Route::get('topStock', [StockController::class, 'getTopBrands']);
// *** BRANDS ***
Route::get('/brands', function () {
    return view('production.brands');
});
Route::get('indexBrand', [BrandController::class, 'index']);
Route::get('listBrand', [BrandController::class, 'list']);
Route::post('saveBrand', [BrandController::class, 'save']);
Route::post('deleteBrand/{id}', [BrandController::class, 'delete']);
Route::get('viewBrand/{id}', [BrandController::class, 'view']);
Route::get('topBrand', [BrandController::class, 'getTopBrands']);
// *** CATEGORIES ***
Route::get('/categories', function () {
    return view('production.categories');
});
Route::get('indexCategory', [CategoryController::class, 'index']);
Route::get('listCategory', [CategoryController::class, 'list']);
Route::post('saveCategory', [CategoryController::class, 'save']);
Route::post('deleteCategory/{id}', [CategoryController::class, 'delete']);
Route::get('viewCategory/{id}', [CategoryController::class, 'view']);
// *** ORDERS ***
Route::get('/orders', function () {
    return view('sales.orders');
});
Route::get('indexOrder', [OrderController::class, 'index']);
Route::get('listOrder', [OrderController::class, 'list']);
Route::post('saveOrder', [OrderController::class, 'save']);
Route::post('deleteOrder/{id}', [OrderController::class, 'delete']);
Route::get('viewOrder/{id}', [OrderController::class, 'view']);
// *** ORDER ITEMS ***
Route::get('indexOrderItem', [OrderItemController::class, 'index']);
Route::get('listOrderItem', [OrderItemController::class, 'list']);
Route::post('saveOrderItem', [OrderItemController::class, 'save']);
Route::post('deleteOrderItem/{id}', [OrderItemController::class, 'delete']);
Route::get('viewOrderItem/{id}', [OrderItemController::class, 'view']);
// *** STAFFS ***
Route::get('/staffs', function () {
    return view('sales.staffs');
});
Route::get('indexStaff', [StaffController::class, 'index']);
Route::get('listStaff', [StaffController::class, 'list']);
Route::post('saveStaff', [StaffController::class, 'save']);
Route::post('deleteStaff/{id}', [StaffController::class, 'delete']);
Route::get('viewStaff/{id}', [StaffController::class, 'view']);
Route::get('getTopStaff/{date}', [StaffController::class, 'getTopStaff']);
// *** STORES ***
Route::get('/stores', function () {
    return view('sales.stores');
});
Route::get('indexStore', [StoreController::class, 'index']);
Route::get('listStore', [StoreController::class, 'list']);
Route::post('saveStore', [StoreController::class, 'save']);
Route::post('deleteStore/{id}', [StoreController::class, 'delete']);
Route::get('viewStore/{id}', [StoreController::class, 'view']);
Route::get('getCAStore/{date}', [StoreController::class, 'getCAStore']);
// *** CUSTOMERS ***
Route::get('/customers', function () {
    return view('sales.customers');
});
Route::get('indexCustomer', [CustomerController::class, 'index']);
Route::get('listCustomer', [CustomerController::class, 'list']);
Route::post('saveCustomer', [CustomerController::class, 'save']);
Route::post('deleteCustomer/{id}', [CustomerController::class, 'delete']);
Route::get('viewCustomer/{id}', [CustomerController::class, 'view']);
// *** ROLES ***
Route::get('/roles', function () {
    return view('admin.roles');
});
Route::get('indexRole', [RoleController::class, 'index']);
Route::get('listRole', [RoleController::class, 'list']);
Route::post('saveRole', [RoleController::class, 'save']);
Route::post('deleteRole/{id}', [RoleController::class, 'delete']);
Route::get('viewRole/{id}', [RoleController::class, 'view']);
// *** LES TEST ***
Route::post('/test', [UserController::class, 'testing']);
Route::post('/testing', [TestController::class, 'save']);

require __DIR__ . '/auth.php';
