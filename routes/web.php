<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;

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
    return view('welcome');
});
// *** USERS ***
Route::post('/saveUser', [UserController::class, 'save']);
Route::get('/listeUser', [UserController::class, 'liste']);
Route::get('/viewUser/{id}', [UserController::class, 'view']);
Route::get('/deleteUser/{id}', [UserController::class, 'delete']);
// *** CONNECTION ***
Route::get('/connexion', function(){
    return view('connexion');
});
Route::post('/loginConnexion', [UserController::class, 'connect']);
// *** LES TEST ***
Route::post('/test', [UserController::class, 'testing']);
Route::post('/testing', [TestController::class, 'save']);
