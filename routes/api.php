<?php

use Illuminate\Http\Request;
use App\user;
Route::group(['middleware'=>'api'],function(){
Route::get('con',function()
{
return user::all();
});
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
