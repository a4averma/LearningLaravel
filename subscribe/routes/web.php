<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/register/confirm/{token}', [
    'uses' => 'Auth\RegisterController@confirmRegistration'
    ]);

Route::get('/home', [
    'uses' => 'HomeController@index',
    'as' => 'profile',
    'middleware' => 'subscriptions',
    'subscriptions' => ['premium', 'standard']]);

Route::get('/subscription', 'SubscriptionController@index')->name('subscribe');
Route::post('/subscription', 'SubscriptionController@pay')->name('subscribe');

Route::get('subscription/response/{payment_id?}/{payment_request_id?}', 'SubscriptionController@getPay')->name('pay');

Route::get('/profile', [
    'uses' => 'ProfileController@index',
    'as' => 'profile',
    'middleware' => 'subscriptions',
    'subscriptions' => ['premium', 'standard']
]);