<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StatusCartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
})->name('home');

Route::group(['middleware' => ['admin']], function(){
    Route::name('category.')->prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('delete/{category}', [CategoryController::class, 'destroy'])
            ->where('category', '[0-9]+')
            ->name('destroy');
        Route::put('{id}/restore', [CategoryController::class, 'restore'])
            ->where('id', '[0-9]+')
            ->name('restore');
    });


    Route::name('product.')->prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('delete/{product}', [ProductController::class, 'delete'])->name('delete');
        Route::put('{id}/restore', [ProductController::class, 'restore'])->name('restore');
    });

            //->middleware(['permission:category.store']);
        // przywrócenie usuniętego wpisu 
            //->middleware(['permission:category.store']);


    Route::name('shoppingCart.')->prefix('shoppingCarts')->group(function () {
        Route::get('', [ShoppingCartController::class, 'index'])->name('index');
        Route::get('/orders', [ShoppingCartController::class, 'indexOrders'])->name('index_orders');
        Route::get('show/{shoppingCart}', [ShoppingCartController::class, 'show'])->name('show');
        Route::get('create', [ShoppingCartController::class, 'create'])->name('create');
        Route::post('store', [ShoppingCartController::class, 'store'])->name('store');
        Route::get('edit/{shoppingCart}', [ShoppingCartController::class, 'edit'])->name('edit');
        Route::put('update/{shoppingCart}', [ShoppingCartController::class, 'update'])->name('update');
        Route::delete('delete/{shoppingCart}', [ShoppingCartController::class, 'delete'])->name('delete');
        Route::get('productDetails/{product}', [ShoppingCartController::class, 'productDetails'])->name('product_details');
        Route::get('editProduct/{product}/{shoppingCart}/{q}', [ShoppingCartController::class, 'editProduct'])->name('edit_product');
        Route::put('updateProduct/{shoppingCartProd}', [ShoppingCartController::class, 'updateProduct'])->name('update_product');
        Route::delete('deleteProduct/{shoppingCart}/{product}', [ShoppingCartController::class, 'deleteProduct'])->name('delete_product');
        Route::get('createProduct/{shoppingCart}', [ShoppingCartController::class, 'createProduct'])->name('create_product');
        Route::post('storeProduct/{shoppingCart}', [ShoppingCartController::class, 'storeProduct'])->name('store_product');
    });

    Route::name('user.')->prefix('users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('show/{user}', [UserController::class, 'show'])->name('show');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('update{user}', [UserController::class, 'update'])->name('update');
        Route::delete('delete/{user}', [UserController::class, 'delete'])->name('delete');
        Route::get('register', [RegisteredUserController::class, 'create'])
                ->middleware('admin')
                ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('admin');
    });
});

Route::get('/',[ProductController::class, 'indexAll'])->name('product.index_all');
Route::get('products/all/{category}',[ProductController::class, 'indexAllCategory'])->name('product.index_all_category');
Route::get('products/details/{product}',[ProductController::class, 'productDetails'])->name('product.details');
Route::get('productDetails/{product}', [ShoppingCartController::class, 'productDetails'])->name('product_details');

Route::get('createProduct/{shoppingCart}', [ShoppingCartController::class, 'createProduct'])->name('create_productClient');

Route::get('/shoppingCartClient', [ShoppingCartController::class, 'indexClient'])->name('shoppingCart.indexClient');//->middleware('permission:shoppingCart.indexClient');
Route::get('editProductClient/{product}/{q}', [ShoppingCartController::class, 'editProductClient'])->name('edit_productClient');//->middleware('permission:edit_productClient');
Route::put('updateProduct/{shoppingCartProd}', [ShoppingCartController::class, 'updateProductClient'])->name('update_productClient');//->middleware('permission:update_productClient');
Route::delete('deleteProduct/{shoppingCart}/{product}', [ShoppingCartController::class, 'deleteProductClient'])->name('delete_productClient');//->middleware('permission:delete_productClient');
Route::post('/pay/{shoppingCart}',[ShoppingCartController::class, 'pay'])->name('pay');//->middleware('permission:pay');
Route::post('/storeProductClient', [ShoppingCartController::class, 'storeProductClient'])->name('store_productClient');//->middleware('permission:store_productClient');
Route::get('/orders', [ShoppingCartController::class, 'indexOrdersClient'])->name('index_ordersClient');//->middleware('permission:index_ordersClient');;
Route::get('/show/{shoppingCart}', [ShoppingCartController::class, 'showClientCart'])->name('showClientCart');//->middleware('permission:shoppingCart.showClientCart');;
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
