<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Captains\HomeController;
use App\Http\Controllers\Api\V1\General\GeneralController;
use App\Http\Controllers\Api\V1\Captains\Auth\AuthController;
use App\Http\Controllers\Api\V1\Passengers\Auth\AuthController as PassengerAuthController;
use App\Http\Controllers\Api\V1\Passengers\Captains\CaptainController;
use App\Http\Controllers\Api\V1\Passengers\Experiences\ExperienceController as PassengerExperienceController;

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

Route::post('upload', [GeneralController::class, 'upload']);

Route::group(['prefix' => 'v1/captains'], function () {

    Route::get('now', function () {
        return Carbon::now()->timestamp;
    });

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify', [AuthController::class, 'check']);
    Route::post('verify-change-password', [AuthController::class, 'verifyChangePassword']);
    Route::post('change-password', [AuthController::class, 'changePassword']);

    Route::middleware('auth:captains')->group(function () {
        Route::get('home', [HomeController::class, 'home']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::apiResource('captain-experiences', ExperienceController::class);
    });
});

#########################################################################
######################    Passenger         #############################
######################                              #####################                             
##########################################################################

Route::group(['prefix' => 'v1/passengers'], function () {

    Route::get('now', function () {
        return Carbon::now()->timestamp;
    });

    Route::post('login', [PassengerAuthController::class, 'login']);
    Route::post('register', [PassengerAuthController::class, 'register']);
    Route::post('verify', [PassengerAuthController::class, 'check']);
    Route::post('verify-change-password', [PassengerAuthController::class, 'verifyChangePassword']);
    Route::post('change-password', [PassengerAuthController::class, 'changePassword']);

    Route::middleware('auth:passengers')->group(function () {
        Route::get('home', [HomeController::class, 'home']);
        Route::get('logout', [PassengerAuthController::class, 'logout']);
        Route::apiResource('passenger-experiences', PassengerExperienceController::class)->only(['index', 'show']);
        Route::apiResource('captains', CaptainController::class)->only(['index', 'show']);
    });
});
