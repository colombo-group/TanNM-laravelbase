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

Route::get('/','Front\HomeController@index');
Route::get('/home','Front\HomeController@Index')->name('home');
Route::get('admin/login' , 'Admin\AdminController@showLogin');

Route::group([	'middleware' => 'AdminMiddleware'], function () {
    Route::get('/admin','Admin\AdminController@index')->name('admin.pages');
    Route::get('admin/user/dellist','Admin\UserController@listDel')->name('admin.user.delList');
	Route::resource('admin/post','Admin\PostController');
	Route::resource('admin/user','Admin\UserController');
	
  });  
Route::get('/post/{id}', 'Front\HomeController@show')->name('front.post.show');
Route::get('register',function(){
	return view('user.register');
})->name('register');

Auth::routes();

Route::post('login','Front\UserController@login')->name('submitLogin');
Route::post('admin/login','Admin\AdminController@submitLogin')->name('admin.submitLogin');
Route::get('/user/{id}', 'Front\UserController@profile')->where('id', '[0-9]+')->name('user.profile');
Route::get('/user/update/{id}', 'Front\UserController@update')->where('id', '[0-9]+')->name('font.user.update');
Route::post('/user/save/{id}', 'Front\UserController@save')->where('id', '[0-9]+')->name('front.user.save');

