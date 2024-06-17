<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubcategoryController;
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
    return view('store.store');
});

Route::get('/show_product', function () {
    return view('store.show_product');
});
Route::get('/login', function () {
    return view('login.login');
})->name('login');


Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

//Dashboard (Gabriel)
Route::get('/db', [SiteController::class, 'dashboardHome'])->name('dashboard.home');

//User
Route::get('/db/list/user', [UserController::class, 'listUser'])->name('dashboard.user');
Route::post('/user/add', [UserController::class, 'addUser']);
Route::post('/user/delete', [UserController::class, 'destroy']);
Route::post('/user/informations/edit', [UserController::class, 'showInformation']);
Route::post('/user/edit', [UserController::class, 'editUser']);

//Categories
Route::get('/db/list/category', [CategoryController::class, 'listCategory'])->name('dashboard.category');
Route::post('/category/add', [CategoryController::class, 'addCategory']);
Route::post('/category/delete', [CategoryController::class, 'destroy']);
Route::post('/category/informations/edit', [CategoryController::class, 'showInformation']);
Route::post('/category/edit', [CategoryController::class, 'editCategory']);

//Subcategory
Route::get('/categories/all/select', [CategoryController::class, 'getCategoryToSelect']);
Route::get('/db/list/subcategory', [SubcategoryController::class, 'listSubcategory'])->name('dashboard.subcategory');
Route::post('/subcategory/add', [SubcategoryController::class, 'addSubcategory']);
Route::post('/subcategory/delete', [SubcategoryController::class, 'destroy']);
Route::post('/subcategory/update', [SubcategoryController::class, 'editSubcategory']);
Route::post('/subcategory/informations/edit', [SubcategoryController::class, 'showInformation']);

//Products
Route::get('/db/list/product', [ProductsController::class,'listProducts'])->name('dashboard.products');
Route::get('/subcategories/all/select', [SubCategoryController::class, 'getSubCategoryToSelect']);
Route::post('/product/add', [ProductsController::class, 'addProduct']);
Route::post('/product/edit', [ProductsController::class, 'editProduct']);
Route::post('/product/informations/edit', [ProductsController::class, 'showOnEdit']);

