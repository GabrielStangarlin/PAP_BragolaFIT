<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('/store', function () {
    return view('store');
});

//Dashboard (Gabriel)
Route::get('/db', function () {
    return view('dashboard/dHome');
});

Route::get('/db/list/user', [UserController::class, 'listUser'])->name('dashboard.user');
