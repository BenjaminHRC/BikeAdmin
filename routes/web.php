<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
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

Route::get('/', function () {
    return view('dashboard');
});
// *** USERS ***
Route::post('/saveUser', [UserController::class, 'save']);
Route::get('/listeUser', [UserController::class, 'liste']);
Route::get('/viewUser/{id}', [UserController::class, 'view']);
Route::post('/deleteUser/{id}', [UserController::class, 'delete']);
// *** CONNECTION ***
Route::get('/connexion', function () {
    return view('connexion');
});
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
// *** STOCKS ***
Route::get('/stocks', function () {
    return view('production.stocks');
});
// *** BRANDS ***
Route::get('/brands', function () {
    return view('production.brands');
});
Route::get('indexBrand', [BrandController::class, 'index']);
Route::get('listBrand', [BrandController::class, 'list']);
Route::post('saveBrand', [BrandController::class, 'save']);
Route::post('deleteBrand/{id}', [BrandController::class, 'delete']);
Route::get('viewBrand/{id}', [BrandController::class, 'view']);
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
// *** STAFFS ***
Route::get('/staffs', function () {
    return view('sales.staffs');
});
Route::get('indexStaff', [StaffController::class, 'index']);
Route::get('listStaff', [StaffController::class, 'list']);
Route::post('saveStaff', [StaffController::class, 'save']);
Route::post('deleteStaff/{id}', [StaffController::class, 'delete']);
Route::get('viewStaff/{id}', [StaffController::class, 'view']);
// *** STORES ***
Route::get('/stores', function () {
    return view('sales.stores');
});
Route::get('indexStore', [StoreController::class, 'index']);
Route::get('listStore', [StoreController::class, 'list']);
Route::post('saveStore', [StoreController::class, 'save']);
Route::post('deleteStore/{id}', [StoreController::class, 'delete']);
Route::get('viewStore/{id}', [StoreController::class, 'view']);
// *** CUSTOMERS ***
Route::get('/customers', function () {
    return view('sales.customers');
});
Route::get('indexCustomer', [CustomerController::class, 'index']);
Route::get('listCustomer', [CustomerController::class, 'list']);
Route::post('saveCustomer', [CustomerController::class, 'save']);
Route::post('deleteCustomer/{id}', [CustomerController::class, 'delete']);
Route::get('viewCustomer/{id}', [CustomerController::class, 'view']);
// *** LES TEST ***
Route::post('/test', [UserController::class, 'testing']);
Route::post('/testing', [TestController::class, 'save']);