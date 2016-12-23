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
    return view('Index');
});
Route::get('/home','HomeController@Index');

Route::group([	'middleware' => 'AdminMiddleware'], function () {
    Route::get('/admin','AdminController@index');

  });  
Route::get('register',function(){
	return view('user.register');
})->name('register');

Auth::routes();
Route::get('/user/{id}', 'UserController@profile')->where('id', '[0-9]+')->name('user.profile');
Route::get('/user/update/{id}', 'UserController@update')->where('id', '[0-9]+')->name('user.update');
Route::post('/user/save/{id}', 'UserController@save')->where('id', '[0-9]+')->name('user.save');
