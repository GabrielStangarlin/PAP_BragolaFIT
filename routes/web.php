<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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

Route::get('/', [SiteController::class, 'store'])->name('store');

Route::get('/store', [SiteController::class, 'store'])->name('store');
Route::get('/subcategoria/{id}', [SiteController::class, 'filterBySubcategory'])->name('subcategory.products');
Route::get('/categoria/{id}', [SiteController::class, 'filterByCategory'])->name('category.products');

//login

Route::post('/register', [AuthController::class, 'registerPost'])->name('user.register');
Route::get('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('user.loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/profilepost', [UserController::class, 'updateProfile'])->name('user.updateProfile');

//Carrinho de compras
Route::get('/check-product-quantity/{id}', [CartController::class, 'checkProductQuantity']);
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart-content', [CartController::class, 'getCartContent'])->name('cart.content');
Route::post('/cart-update', [CartController::class, 'updateCartQuantity'])->name('cart.updateQuantity');
Route::post('/cart-checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
Route::get('(cart/verification/content', [CartController::class, 'verifyContent'])->name('cart.verification.for.cartContent');

//Detalhes Carrinho
Route::get('/cart-details', [CartController::class, 'cartDetails'])->name('cart.details');
Route::post('/delete/product/cart', [CartController::class, 'removeItem'])->name('cart.delete');

//Dashboard (Gabriel)
Route::get('/db', [SiteController::class, 'dashboardHome'])->name('dashboard.home');
Route::get('/api/product-subcategories', [ProductsController::class, 'getProductSubcategories']);

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
Route::get('/db/list/product', [ProductsController::class, 'listProducts'])->name('dashboard.products');
Route::get('/subcategories/all/select', [SubCategoryController::class, 'getSubCategoryToSelect']);
Route::post('/product/add', [ProductsController::class, 'addProduct']);
Route::post('/product/edit', [ProductsController::class, 'editProduct']);
Route::post('/product/informations/edit', [ProductsController::class, 'showOnEdit']);
Route::post('/product/delete', [ProductsController::class, 'deleteProduct']);

//Orders
Route::get('/db/list/order', [OrderController::class, 'listOrder']);
Route::post('/order/information/get', [OrderController::class, 'orderInfo']);
Route::post('/order/update', [OrderController::class, 'updateOrder']);

Route::get('/search', [ProductsController::class, 'search'])->name('search');

//wishlist
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/profile/wishlist', [WishlistController::class, 'index'])->name('profile.wishlist');
Route::get('/wishlist/has-items', [WishlistController::class, 'hasWishlistItems'])->name('wishlist.has-items');


//pesquisa
Route::get('/search', [SiteController::class, 'search'])->name('search');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.process');


