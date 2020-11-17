<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers as CC;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'invite'],function(){
    Route::get('user_invite',[CC\InviteController::class,'user_invite']);
    Route::get('user_two_invite',[CC\InviteController::class,'user_two_invite']);
    Route::get('user_three_invite',[CC\InviteController::class,'user_three_invite']);
});





//'namespace'=>'App\Http\Controllers'
//Route::group(['namespace'=>'23322323CC\A322323232323A'],function(){
//	Route::get('log',[CC\ApiController::class,'log']);//要不就这样
//	// Route::get('log',"ApiController@log");
//	// Route::get('log',[ApiController::class,'log']);//这个不行
//});
//
//Route::group(['middleware' => 'auth.jwt'], function() {
//    Route::get('user', [CC\ApiController::class,'getAuthUser']);
//});
//
//Route::get('logout', [CC\ApiController::class,'logout']);
//Route::get('user', [CC\ApiController::class,'getAuthUser']);

