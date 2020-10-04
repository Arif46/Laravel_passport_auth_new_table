<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register','AuthController@Register');
Route::post('/login','AuthController@login');


Route::middleware('auth:api')->group (function () {

    Route::post('/studentCreate', 'StudentController@create'); 
  
});

Route::group(
    [
        'prefix'=>'auth/device'
    ],function ()
    {
        Route::post('signup','DeviceController@signupDevice');
        Route::post('login','DeviceController@login');

        Route::middleware('auth:device')->group (function () {

            Route::post('/equipmentadd','EquipmentController@index');
          
        });
 
    });
  