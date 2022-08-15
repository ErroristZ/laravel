<?php

use App\Http\Controllers\IndexController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Index', 'prefix' => 'index'], function (){
    Route::get('index', [IndexController::class, 'index'])->name('index');
    Route::get('info', [IndexController::class, 'info'])->name('info');
    Route::get('store', [IndexController::class, 'store'])->name('store');
});
