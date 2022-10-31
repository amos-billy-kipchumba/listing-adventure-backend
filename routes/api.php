<?php

use App\Http\Controllers\API\DineUserController;
use App\Http\Controllers\API\HouseDetailsController;
use App\Http\Controllers\API\FiftyController;
use App\Http\Controllers\SeventyFiveController;
use App\Http\Controllers\API\HundredController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LikePageController;
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

// Like page Routes
Route::post('/add-house-like', [LikePageController::class, 'storeLike']);
Route::get('/get-house-like/{id}', [LikePageController::class, 'getHouseLike']);

//Booking Routes
Route::delete('/delete-customer-booking/{id}', [BookingController::class, 'deleteCustomerBooking']);
Route::get('/get-total-booked-for-host/{id}', [BookingController::class, 'getTotalBookedForHost']);
Route::get('/get-total-booked/{id}', [BookingController::class, 'getTotalBooked']);
Route::get('/get-booked-info/{id}', [BookingController::class, 'getBookedInfo']);
Route::get('/get-booked-dates/{id}', [BookingController::class, 'getBookedDates']);
Route::post('/add-booking-info', [BookingController::class, 'storeBookingInfo']);

//Thousand Routes
Route::get('/get-join-thousand-details/{id}', [HundredController::class, 'getJoinThousandDetails']);
Route::get('/get-thousand-details/{id}', [HundredController::class, 'getThousandDetails']);

//Hundred Routes
Route::post('/delete-house-part16/{house_id}', [HundredController::class, 'deleteHousePart16']);
Route::post('/delete-house-part15/{house_id}', [HundredController::class, 'deleteHousePart15']);
Route::post('/delete-house-part14/{house_id}', [HundredController::class, 'deleteHousePart14']);
Route::post('/delete-house-part13/{house_id}', [HundredController::class, 'deleteHousePart13']);
Route::post('/delete-house-part12/{house_id}', [HundredController::class, 'deleteHousePart12']);
Route::post('/delete-house-part11/{house_id}', [HundredController::class, 'deleteHousePart11']);
Route::post('/delete-house-part10/{house_id}', [HundredController::class, 'deleteHousePart10']);
Route::post('/delete-house-part9/{house_id}', [HundredController::class, 'deleteHousePart9']);
Route::post('/delete-house-part8/{house_id}', [HundredController::class, 'deleteHousePart8']);
Route::post('/delete-house-part7/{house_id}', [HundredController::class, 'deleteHousePart7']);
Route::post('/delete-house-part6/{house_id}', [HundredController::class, 'deleteHousePart6']);
Route::post('/delete-house-part5/{house_id}', [HundredController::class, 'deleteHousePart5']);
Route::post('/delete-house-part4/{house_id}', [HundredController::class, 'deleteHousePart4']);
Route::post('/delete-house-part3/{house_id}', [HundredController::class, 'deleteHousePart3']);
Route::post('/delete-house-part2/{house_id}', [HundredController::class, 'deleteHousePart2']);
Route::post('/delete-house-part/{house_id}', [HundredController::class, 'deleteHousePart']);

Route::get('/get-hundred-details', [HundredController::class, 'getHundredDetails']);
Route::get('/get-sun-details/{user_id}', [HundredController::class, 'getSunDetails']);
Route::post('/update-hundred-details/{user_id}', [HundredController::class, 'updateHundredDetails']);
Route::post('/add-hundred-details', [HundredController::class, 'storeHundred']);

//Seventy Routes
Route::get('/get-join-seventy-five-details/{id}', [SeventyFiveController::class, 'getJoinFiveDetails']);
Route::get('/get-seventy-five-details/{id}', [SeventyFiveController::class, 'getSeventyFiveDetails']);
Route::get('/get-stars-details/{user_id}', [SeventyFiveController::class, 'getStarsDetails']);
Route::post('/update-seventy_five-details/{user_id}', [SeventyFiveController::class, 'updateSeventyFiveDetails']);
Route::post('/add-seventy_five-details', [SeventyFiveController::class, 'storeSeventyFive']);

// Fifty Routes
Route::get('/get-join-fifty-details/{id}', [FiftyController::class, 'getJoinFiftyDetails']);
Route::get('/get-fifty-details/{id}', [FiftyController::class, 'getFiftyDetails']);
Route::get('/get-moon-details/{user_id}', [FiftyController::class, 'getMoonDetails']);
Route::post('/update-fifty-details/{user_id}', [FiftyController::class, 'updateFiftyDetails']);
Route::post('/add-fifty-details', [FiftyController::class, 'storeFifty']);

// House Details routes
Route::get('/get-all-house-more-details/{id}', [HouseDetailsController::class, 'getAllHouseMoreDetails']);


Route::get('/get-join-magic-details', [HouseDetailsController::class, 'getJoinMagicDetails']);
Route::get('/get-magic-details/{magic_id}', [HouseDetailsController::class, 'getMagicDetails']);
Route::get('/get-hello-details/{user_id}', [HouseDetailsController::class, 'getHelloDetails']);

Route::get('/get-host-houses-details/{user_id}', [HouseDetailsController::class, 'getHostHousesDetails']);

Route::get('/get-zero-details/{id}', [HouseDetailsController::class, 'getZeroDetails']);
Route::get('/get-house-details', [HouseDetailsController::class, 'getHouseDetails']);
Route::post('/update-house-details/{user_id}', [HouseDetailsController::class, 'updateHouseDetails']);
Route::post('/add-house-details', [HouseDetailsController::class, 'storeHouseDetails']);

// Dine users Routes
Route::post('/login', [DineUserController::class, 'getIn']);
Route::get('/get-host-join-details/{id}', [DineUserController::class, 'getHostJoinDetails']);
Route::get('/get-host-specific-details/{id}', [DineUserController::class, 'getHostSpecificDetails']);
Route::get('/get-one-host-details/{id}', [DineUserController::class, 'getOneHostDetails']);
Route::delete('/delete-customer/{id}', [DineUserController::class, 'deleteCustomer']);
Route::delete('/delete-host/{id}', [DineUserController::class, 'deleteHost']);
Route::get('/get-all-host-details/{id}', [DineUserController::class, 'getAllHostDetails']);
Route::get('/get-host-details/{id}', [DineUserController::class, 'getHostDetails']);
Route::post('/update-customer-profile-details/{user_id}', [DineUserController::class, 'updateCustomerProfileDetails']);
Route::post('/add-host', [DineUserController::class, 'storeUser']);
Route::post('/add-venturer', [DineUserController::class, 'storeVenturer']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
