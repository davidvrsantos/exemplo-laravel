<?php

use App\Http\Controllers\Api\Products\CreateProductController;
use App\Http\Controllers\Api\Products\DestroyProductController;
use App\Http\Controllers\Api\Products\ListProductsController;
use App\Http\Controllers\Api\Products\ShowProductController;
use App\Http\Controllers\Api\Products\UpdateProductController;
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

Route::group(['prefix' => 'products'], function () {
    Route::put('/{id}', UpdateProductController::class);
    Route::get('', ListProductsController::class);
    Route::post('', CreateProductController::class);
    Route::get('/{id}', ShowProductController::class);
    Route::delete('/{id}', DestroyProductController::class);
});
