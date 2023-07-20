<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('contact/list', [RouteController::class, 'contactList']);
Route::get('order/list', [RouteController::class, 'orderList']);

// post
Route::post('category/create', [RouteController::class, 'categoryCreate']);
Route::post('contact/create', [RouteController::class, 'contactCreate']);
Route::get('category/delete/{id}', [RouteController::class, 'delete']);
Route::post('category/details', [RouteController::class, 'details']);
Route::post('category/update', [RouteController::class, 'update']);

// product list
// 127.0.0.1:8080/api/product/list
// category
// 127.0.0.1:8080/api/category/list
// contact list
// 127.0.0.1:8080/api/contact/list
// order list
// 127.0.0.1:8080/api/order/list

// post
// create category
// 127.0.0.1:8080/api/category/create [name]
// create contact
//127.0.0.1:8080/api/contact/create [name,email,message]
// delete category
// 127.0.0.1:8080/api/category/delete  [id]
// 127.0.0.1:8080/api/category/delete [id(url)] ....GET....
// category details
// 127.0.0.1:8080/api/category/details
// category Update
// 127.0.0.1:8080/api/category/update [id.name]
