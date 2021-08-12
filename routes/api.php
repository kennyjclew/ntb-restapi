<?php

use Illuminate\Http\Request;
use App\Model\Member;
// use App\GetController;
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



Route::get('/fetch_carparks_info', 'GetController@fetch_carparks_info');
Route::get('/fetch_carparks_lot_availability', 'GetController@fetch_carpark_lot_availability');  
Route::get('/get_carparks_info', 'GetController@get_carparks_info'); 
Route::get('/get_nearest_carparks', 'GetController@get_nearest_carparks');  
Route::get('/sorted_carparks_total_lots', 'GetController@sorted_carparks_total_lots'); 
Route::get('/sorting_carparks_gantry', 'GetController@sorting_carparks_gantry');


Route::post('/add_feedback','FeedbackController@add_feedback');

