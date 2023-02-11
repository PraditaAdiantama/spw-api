<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionsController;
use App\Models\Catalog;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => ''], function () {
    Route::middleware('auth:api')->group(function (){
        Route::apiResource('products', ProductController::class);
        Route::apiResource('catalogs', CatalogController::class);
        Route::apiResource('employes', EmployeController::class);
        Route::post('transactions', [TransactionsController::class, 'store']);
    });

    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth', [AuthController::class, 'index']);
});
