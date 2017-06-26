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
Route::get('/home', 'HomeController@index')->name('home');

//Сторінки авторизації, реєстрації, скидання пароля.
Auth::routes();
//Реєстрація з підтвердженням пароля по емейлу.
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

//Сторінка керування користувачами з фільтром по емейлу, імені та сортуванням
Route::resource('users', 'UserController');

//Сторінка офіціанта з списком замовлень та їх статусами
//Сторінка офіціанта з створенням нового замовлення
Route::resource('orders', 'OrderController');
Route::post('/orders/confirmed', 'OrderController@confirmed')->name('confirmed');
Route::post('/orders/json', 'OrderController@json');

//Сторінка кухні з усіма активними замовленнями (готуються/готові)
Route::get('/cuisine', 'CuisineController@index')->name('cuisine');
Route::get('/cuisine/json', 'CuisineController@json');













