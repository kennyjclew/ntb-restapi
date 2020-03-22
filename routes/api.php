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




Route::get('/v1/cars', function (Request $request) {    
	return response()->json([ 'cars' => ['registration' => 'ABC001',            'dateRegistered' => '2019-01-01',            'color' => 'black',            'make' => 'tesla',            'model' => 's'        ]    ], 200);});

// Route::get('get_nationality/{nationality}', 'GetController@get_nationality');
// Route::middleware(['auth:api'])->group(function () {    
// 	// Route::post('/v1/cars', 'Controller_Cars@post');    
// 	// Route::get('/v1/cars', 'Controller_Cars@get');    
// 	// Route::put('/v1/cars', 'Controller_Cars@put');    
// 	// Route::delete('/v1/cars', 'Controller_Cars@delete');    
// 	// Route::post('/v1/motorbikes', 'Controller_Motorbikes@post');    
// 	// Route::get('/v1/motorbikes ', 'Controller_ Motorbikes @get');    
// 	// Route::put('/v1/motorbikes ', 'Controller_ Motorbikes @put');    
// 	// Route::delete('/v1/motorbikes ', 'Controller_ Motorbikes @delete');

// 	Route::get('/v1/test', 'GetController@fetch_data_gov');  
// }

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
