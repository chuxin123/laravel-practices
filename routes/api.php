<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\Order;
use App\Http\Controllers\Order\Mail;
use App\Http\Controllers\Order\Project;
use App\Http\Controllers\Order\Refund;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("order/v1")->group(function () {
    Route::controller(Order::class)->group(function () {
        Route::get('/detail/{orderNo}', 'detail');
        Route::get('/pageList', 'orderList');
        Route::post('/create', 'createOrder');
    });
});
