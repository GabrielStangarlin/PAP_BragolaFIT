<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::get('/store', function () {
    return view('store');
});


Route::get('/show_product', function () {
    return view('show_product');
});

//Dashboard (Gabriel)
Route::get('/db', [SiteController::class, 'dashboardHome'])->name('dashboard.home');

//User
Route::get('/db/list/user', [UserController::class, 'listUser'])->name('dashboard.user');
Route::post('/user/add', [UserController::class, 'addUser']);
Route::post('/user/delete', [UserController::class, 'destroy']);
Route::post('/user/informations/edit', [UserController::class, 'showInformation']);
