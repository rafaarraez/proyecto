<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
Route::post('create', [UsersController::class, 'create']);
Route::get('index', [UsersController::class, 'index']);
Route::get('user/{id}', [UsersController::class, 'getUser']);
Route::post('edit/update/{id}', [UsersController::class, 'update']);
Route::post('user/switch-active/{id}', [UsersController::class, 'switchActiveUser']);
Route::post('edit/update/password/{id}', [UsersController::class, 'changePassword']);

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
