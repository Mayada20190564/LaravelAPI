<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ProductController;
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

Route::post('register' , "AuthController@register");
Route::post('login' , "AuthController@login");

Route::group(['middleeare'=>['auth:sanctum']], function(){
    Route::resources(
        ["product"=>"ProductController"]
     );
     Route::post('logout' , "AuthController@logout");
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
