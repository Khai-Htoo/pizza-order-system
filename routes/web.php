<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
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

// login register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {
        // category
        Route::group(['prefix' => 'category'], function () {
             Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // admin account
        Route::prefix('admin')->group(function () {
              // password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            // profile
            Route::get('accountDetails', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');
            // admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/{id}', [AdminController::class, 'change'])->name('admin#change');
            Route::get('changeStatus', [adminController::class, 'changeStatus'])->name('admin#ajaxChangeStatus');

        });

        // user list
        Route::prefix('userList')->group(function () {
           Route::get('list', [UserListController::class, 'list'])->name('userList#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('userlist#delete');
            Route::get('changeStatus', [adminController::class, 'changeUserStatus'])->name('admin#ajaxChangeStatus');
        });

        // product
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });

        // order
        Route::prefix('order')->group(function () {
            route::get('order', [OrderController::class, 'order'])->name('admin#orderList');
            route::get('status', [OrderController::class, 'status'])->name('admin#getStatus');
            route::get('changestatus', [OrderController::class, 'changestatus'])->name('admin#changestatus');
            Route::get('orderList/{orderCode}', [OrderController::class, 'orderList'])->name('admin#orderShow');

        });

        // get contactMsg
        Route::get('get', [ContactController::class, 'get'])->name('admin#getContact');
        Route::get('deleteSent/{id}', [ContactController::class, 'deleteSent'])->name('admin#deleteSent');
    });

    // user home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('homePage', [UserController::class, 'home'])->name('user#home');
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('history', [UserController::class, 'history'])->name('user#history');

        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#accountChange');
        });

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'details'])->name('pizza#details');
        });

        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class, 'list'])->name('cart#list');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('list', [AjaxController::class, 'pizzaList'])->name('pizza#pizzaList');
            Route::get('cart', [AjaxController::class, 'pizzaCart'])->name('pizza#pizzaCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear', [AjaxController::class, 'clear'])->name('ajax#clear');
            Route::get('remove', [AjaxController::class, 'remove'])->name('ajax#remove');
            Route::get('viewCount', [AjaxController::class, 'view'])->name('ajax#view');

        });

        Route::prefix('contact')->group(function () {
            Route::get('contactPage', [ContactController::class, 'contactPage'])->name('user#contact');
            Route::post('sent', [ContactController::class, 'sent'])->name('user#sent');

        });
    });
});
