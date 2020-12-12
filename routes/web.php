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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

    Route::view('/home', 'home');

  //  Route::view('/admin', 'admin')->middleware('auth:admin');

    Route::middleware('auth:admin')->group(function () {
        Route::resource('posts', 'PostController')->middleware('auth:admin');
        Route::get('posts/restore/{id}' , 'PostController@restore')->name('posts.restore'); 
        Route::get('posts/forceDelete/{id}' , 'PostController@forceDelete')->name('posts.force');
    });
 