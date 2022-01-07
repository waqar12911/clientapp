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

//client
Route::post('/clients_login','App\Http\Controllers\API\UserController@clients_login')->name('clients_login');
// Route::post('/clients_login',function(){
// return "abc";    })->name('clients_login');

/** Client Transection */
Route::post('/add_client_transection','App\Http\Controllers\API\ClientController@addClientTransction');



Route::post('/clients_Edit/{id}','App\Http\Controllers\API\UserController@clients_Edit')->name('clients_Edit');
Route::post('/client_maxboost','App\Http\Controllers\API\UserController@client_maxboost')->name('client_maxboost');
Route::get('/get-client/{id}','App\Http\Controllers\API\UserController@getClients')->name('getClients');

Route::post('/add-client','App\Http\Controllers\API\UserController@addClients')->name('addClients');

Route::post("upload",[App\Http\Controllers\API\UserController::class,'upload']);


// shock_pay
Route::post('/create_shock_pay_contact','App\Http\Controllers\API\UserController@create_shock_pay')->name('shock_pay');
Route::get('/get_shock_pay_contact/{client_id}','App\Http\Controllers\API\UserController@get_shock_pay')->name('get_shock_pay');
Route::post('/delete_shock_pay_contact/','App\Http\Controllers\API\UserController@delete_shock_pay')->name('delete_shock_pay');




//merchant

Route::post('/merchants_login','App\Http\Controllers\API\UserController@merchants_login')->name('merchants_login');
Route::post('/merchants_Edit/{id}','App\Http\Controllers\API\UserController@merchants_Edit')->name('merchants_Edit');
Route::post('/merchant_maxboost','App\Http\Controllers\API\UserController@merchant_maxboost')->name('merchant_maxboost');
Route::get('/get-merchants','App\Http\Controllers\API\UserController@getMerchants')->name('getMerchants');

//routings
Route::get('/get-routing-nodes','App\Http\Controllers\API\UserController@getRoutingNodes')->name('getRoutingNodes');

//fundings
Route::get('/get-funding-nodes','App\Http\Controllers\API\UserController@getFundingNodes')->name('getFundingNodes');

//merchant
Route::post('/add-transction','App\Http\Controllers\API\UserController@addTransction')->name('addTransction');
// addAlphaTransction

Route::post('/add-alpha-transction','App\Http\Controllers\API\AlphaController@addAlphaTransction')->name('addAlphaTransction');

// 2fa for merchant
Route::post('/check-merchant','App\Http\Controllers\API\UserController@checkMerchant')->name('checkMerchant');

Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});
Route::post('/remote-save','App\Http\Controllers\API\UserController@remote_save')->name('remote_save');

Route::get('shockpay','App\Http\Controllers\API\ShockPayController@index')->name('shockpay');
    Route::get('shockpay-edit/{id}','App\Http\Controllers\API\ShockPayController@shockpayEdit')->name('shockpayEdit');
    Route::post('create-shockpay','App\Http\Controllers\API\ShockPayController@createShockpay')->name('createshockpay');
    Route::post('update-shockpay/{id}','App\Http\Controllers\API\ShockPayController@updateShockpay')->name('updateshockpay');
    Route::get('shockpay-delete/{id}','App\Http\Controllers\API\ShockPayController@shockpayDelete')->name('shockpayDelete');

    Route::get('channels','App\Http\Controllers\API\ChannelController@index')->name('channels');
    Route::get('channel-edit/{id}','App\Http\Controllers\API\ChannelController@channelEdit')->name('channelEdit');
    Route::get('add-channel','App\Http\Controllers\API\ChannelController@addChannel')->name('addchannel');
    Route::post('create-channel','App\Http\Controllers\API\ChannelController@createChannel')->name('createchannel');
    Route::post('update-channel/{id}','App\Http\Controllers\API\ChannelController@updateChannel')->name('updatechannel');
    Route::get('channel-delete/{id}','App\Http\Controllers\API\ChannelController@channelDelete')->name('channelDelete');