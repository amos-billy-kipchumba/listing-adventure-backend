<?php

use App\Http\Controllers\API\DineUserController;
use App\Http\Controllers\API\HouseDetailsController;
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
Route::get('/get-house-details', [HouseDetailsController::class, 'getHouseDetails']);
Route::post('/add-house-details', [HouseDetailsController::class, 'storeHouseDetails']);
Route::post('/login', [DineUserController::class, 'getIn']);
Route::post('/add-host', [DineUserController::class, 'storeUser']);
Route::post('/add-venturer', [DineUserController::class, 'storeVenturer']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
