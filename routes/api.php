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

/* 
 .----------------.  .----------------.  .----------------.  .----------------.   .----------------.  .----------------.  .----------------.  .----------------.  .----------------.  .----------------. 
| .--------------. || .--------------. || .--------------. || .--------------. | | .--------------. || .--------------. || .--------------. || .--------------. || .--------------. || .--------------. |
| | _____  _____ | || |    _______   | || |  _________   | || |  _______     | | | |  _______     | || |     ____     | || | _____  _____ | || |  _________   | || |  _________   | || |    _______   | |
| ||_   _||_   _|| || |   /  ___  |  | || | |_   ___  |  | || | |_   __ \    | | | | |_   __ \    | || |   .'    `.   | || ||_   _||_   _|| || | |  _   _  |  | || | |_   ___  |  | || |   /  ___  |  | |
| |  | |    | |  | || |  |  (__ \_|  | || |   | |_  \_|  | || |   | |__) |   | | | |   | |__) |   | || |  /  .--.  \  | || |  | |    | |  | || | |_/ | | \_|  | || |   | |_  \_|  | || |  |  (__ \_|  | |
| |  | '    ' |  | || |   '.___`-.   | || |   |  _|  _   | || |   |  __ /    | | | |   |  __ /    | || |  | |    | |  | || |  | '    ' |  | || |     | |      | || |   |  _|  _   | || |   '.___`-.   | |
| |   \ `--' /   | || |  |`\____) |  | || |  _| |___/ |  | || |  _| |  \ \_  | | | |  _| |  \ \_  | || |  \  `--'  /  | || |   \ `--' /   | || |    _| |_     | || |  _| |___/ |  | || |  |`\____) |  | |
| |    `.__.'    | || |  |_______.'  | || | |_________|  | || | |____| |___| | | | | |____| |___| | || |   `.____.'   | || |    `.__.'    | || |   |_____|    | || | |_________|  | || |  |_______.'  | |
| |              | || |              | || |              | || |              | | | |              | || |              | || |              | || |              | || |              | || |              | |
| '--------------' || '--------------' || '--------------' || '--------------' | | '--------------' || '--------------' || '--------------' || '--------------' || '--------------' || '--------------' |
 '----------------'  '----------------'  '----------------'  '----------------'   '----------------'  '----------------'  '----------------'  '----------------'  '----------------'  '----------------' 

*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@userProfile');
    Route::get('payment', 'PaymentsController@make')->name('payment.make');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country', 'Country\CountryController@country');
Route::get('country/{id}', 'Country\CountryController@countryByID');
Route::post('country', 'Country\CountryController@countrySave');
Route::put('country/{id}', 'Country\CountryController@countryUpdate');
Route::delete('country/{id}', 'Country\CountryController@countryDelete'); 
Route::apiResource('country', 'Country\Country');



