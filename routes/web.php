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
Route::get('/', function () {
                return redirect('admin-login');
            });
            Route::get('/__clear__', function(){

            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            Artisan::call('view:clear');



return 'cache cleard';
});



Route::get('/merchant_maxboost','App\Http\Controllers\API\UserController@merchant_maxboost')->name('merchant_maxboost');
Route::get('/client_maxboost','App\Http\Controllers\API\UserController@client_maxboost')->name('client_maxboost');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

        Route::group(['middleware' => 'auth'], function () {
    	Route::get('download_transections','App\Http\Controllers\TransectionAlphaController@download_excel')->name('download_excel');


    Route::get('download_hsmkey','App\Http\Controllers\TransectionAlphaController@download_hsmkey')->name('download_hsmkey');
    

	
    Route::get('upload_transection','App\Http\Controllers\TransectionAlphaController@upload_csv')->name('upload_csv');
    Route::get('delete_transections','App\Http\Controllers\TransectionAlphaController@delete_transections')->name('delete_transections');
    Route::post('import_transections','App\Http\Controllers\TransectionAlphaController@import_transections')->name('import_transections');
    
    
    Route::get('filter-transection','App\Http\Controllers\TransectionAlphaController@filterTransection')->name('filterTransection');

	Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
    		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
    		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
    		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
    		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
    		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
        
            
        });

Route::post('do_verify','App\Http\Controllers\UserController@do_verify')->name('do_verify');

Route::post('do_login','App\Http\Controllers\UserController@do_login')->name('do_login');
Route::get('admin-login','App\Http\Controllers\UserController@admin_login')->name('admin_login');


Route::post('forgot-password','App\Http\Controllers\UserController@reset_password')->name('forgot-password');
Route::get('forgot-password','App\Http\Controllers\UserController@reset_link')->name('reset-password');
Route::post('update-password','App\Http\Controllers\UserController@update')->name('update-password');
Route::get('change-password','App\Http\Controllers\UserController@update_form')->name('change-password');
Route::post('client/changeTempPassword','App\Http\Controllers\UserController@clientChangeTempPassword');	//By Muhammad Waqar
Route::post('client/changePassword','App\Http\Controllers\UserController@clientChangePassword'); 		//By Muhammad Waqar



Route::group(['middleware' => 'auth'], function () {

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

//  TransectionAlphaController
    Route::get('get-transactions-alpha','App\Http\Controllers\TransectionAlphaController@getTransactionsalpha')->name('getTransactionsalpha');
    Route::get('filter-transection','App\Http\Controllers\TransectionAlphaController@filterTransection')->name('filterTransection');
});

// Email gema 
Route::get('/send-mail','App\Http\Controllers\MailController@send_mail')->name('send_mail');
Route::get('/daily_mails','App\Http\Controllers\MailController@daily_mails')->name('daily_mails');
Route::get('/weekly_mails','App\Http\Controllers\MailController@weekly_mails')->name('weekly_mails');
Route::get('/monthly_mails','App\Http\Controllers\MailController@monthly_mails')->name('monthly_mails');



// Daily Manual Email Route
Route::post('/daily-manual-email','App\Http\Controllers\MailController@dailyManualEmail')->name('dailyMail');
// Weekly Manual Email Route
Route::post('/weekly-manual-email','App\Http\Controllers\MailController@weeklyManualEmail')->name('weeklyMail');
// Monthly Manual Email Route

Route::any('/change-status','App\Http\Controllers\MailController@changeStatus');



// E-mail Alpha
Route::post('/is-email-allow','App\Http\Controllers\MailController@isEmailAllow');
Route::post('/boot-email','App\Http\Controllers\MailController@bootManualEmail');
Route::get('/client/requestNewMemberToken','App\Http\Controllers\MailController@clientRequestNewMemberToken');		//By Muhammad Waqar
Route::post('/client/verify2faCode','App\Http\Controllers\MailController@clientVerify2faCode');		//By Muhammad Waqar


Route::post('/remote-save','App\Http\Controllers\API\UserController@remote_save')->name('remote_save');


    Route::get('shockpay','App\Http\Controllers\ShockPayController@index')->name('shockpay');
    Route::get('shockpay-edit/{id}','App\Http\Controllers\ShockPayController@shockpayEdit')->name('shockpayEdit');
    Route::get('add-shockpay','App\Http\Controllers\ShockPayController@addShockpay')->name('addshockpay');
    Route::post('create-shockpay','App\Http\Controllers\ShockPayController@createShockpay')->name('createshockpay');
    Route::post('update-shockpay/{id}','App\Http\Controllers\ShockPayController@updateShockpay')->name('updateshockpay');
    Route::get('shockpay-delete/{id}','App\Http\Controllers\ShockPayController@shockpayDelete')->name('shockpayDelete');

    Route::get('channels','App\Http\Controllers\ChannelController@index')->name('channels');
    Route::get('channel-edit/{id}','App\Http\Controllers\ChannelController@channelEdit')->name('channelEdit');
    Route::get('add-channel','App\Http\Controllers\ChannelController@addChannel')->name('addchannel');
    Route::post('create-channel','App\Http\Controllers\ChannelController@createChannel')->name('createchannel');
    Route::post('update-channel/{id}','App\Http\Controllers\ChannelController@updateChannel')->name('updatechannel');
    Route::get('channel-delete/{id}','App\Http\Controllers\ChannelController@channelDelete')->name('channelDelete');