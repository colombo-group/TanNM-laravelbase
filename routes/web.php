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
    Route::get('/admin/user/restore/{id}', 'Admin\UserController@restore')->name('admin.user.restore');
    Route::get('admin/user/recycle','Admin\UserController@recycle')->name('admin.recycle');
    Route::get('admin/delete/{id}','Admin\UserController@delete')->name('admin.delete');
	Route::resource('admin/page','Admin\PageController');
	Route::resource('admin/user','Admin\UserController');
	
  });  
Route::get('/page/{id}', 'Front\HomeController@show')->name('front.page.show');
Route::get('register',function(){
	return view('user.register');
})->name('register');

Auth::routes();

Route::post('login','Front\UserController@login')->name('submitLogin');
Route::post('admin/login','Admin\AdminController@submitLogin')->name('admin.submitLogin');
Route::get('/user/{id}', 'Front\UserController@profile')->where('id', '[0-9]+')->name('user.profile');
Route::get('/user/update/{id}', 'Front\UserController@update')->where('id', '[0-9]+')->name('font.user.update');
Route::post('/user/save/{id}', 'Front\UserController@save')->where('id', '[0-9]+')->name('front.user.save');

