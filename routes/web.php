<?php

use App\Http\Controllers\ProductController;
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
// *** CATEGORIES ***
Route::get('/categories', function () {
    return view('production.categories');
});
// *** ORDERS ***
Route::get('/orders', function () {
    return view('sales.orders');
});
// *** STAFFS ***
Route::get('/staffs', function () {
    return view('sales.staffs');
});
// *** STORES ***
Route::get('/stores', function () {
    return view('sales.stores');
});
// *** CUSTOMERS ***
Route::get('/customers', function () {
    return view('sales.customers');
});
// *** LES TEST ***
Route::post('/test', [UserController::class, 'testing']);
Route::post('/testing', [TestController::class, 'save']);