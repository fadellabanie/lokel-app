<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','as' => 'admin.','middleware'=>'auth'], function () {
    Route::get('/',[App\Http\Controllers\Dashboard\HomeController::class,'index'])->name('admin');

    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class);
    Route::resource('admins', App\Http\Controllers\Dashboard\AdminController::class);

    Route::resource('cities', App\Http\Controllers\Dashboard\CityController::class);
    Route::resource('countries', App\Http\Controllers\Dashboard\CountryController::class);
 
    Route::resource('roles', App\Http\Controllers\Dashboard\RoleController::class);
    Route::resource('activity-logs', App\Http\Controllers\Dashboard\ActivityLogController::class);
    Route::resource('app-settings', App\Http\Controllers\Dashboard\AppSettingController::class);
    Route::resource('notifications', App\Http\Controllers\Dashboard\NotificationController::class);
    Route::resource('static-pages', App\Http\Controllers\Dashboard\StaticPageController::class);
    Route::resource('interests', App\Http\Controllers\Dashboard\InterestController::class);

    Route::get('admin',function(){
        return 'admin';
    });



});
