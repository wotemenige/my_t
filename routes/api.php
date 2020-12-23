<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers as CC;
use App\Http\Controllers\Api as AA;

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

Route::any('wechat/get_access',[AA\WechatController::class,'get_access']);//获取授权
Route::any('wechat/back_auth',[AA\WechatController::class,'back_auth'])->middleware('web');//授权回调

Route::group(['prefix'=>'wechat','middleware'=>['web','wechat.user']],function(){
    Route::any('book_list',[AA\WechatController::class,'book_list']);//列表
    Route::any('submit_luck_num',[AA\WechatController::class,'submit_luck_num']);//提交数字
    Route::any('book_result',[AA\WechatController::class,'book_result']);//列表
    Route::any('book_record',[AA\WechatController::class,'book_record']);//列表
    Route::any('order_info',[AA\WechatController::class,'order_info']);//列表
    Route::any('video_list',[AA\WechatController::class,'video_list']);//列表
    Route::any('video_add',[AA\WechatController::class,'video_add']);//列表
    Route::any('fileUpload',[AA\WechatController::class,'fileUpload']);//列表

});

Route::any('video_list',[AA\WechatController::class,'video_list']);//列表
Route::any('video_add',[AA\WechatController::class,'video_add']);//列表
Route::any('fileUpload',[AA\WechatController::class,'fileUpload']);//列表


