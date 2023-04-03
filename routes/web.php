<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function(){
    Route::get('/', 'App\Http\Controllers\HomeController@view')->name('home');
    Route::get('/profile', 'App\Http\Controllers\ProfileController@view')->name('profile');
});

// Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
// Route::get('/register', 'App\Http\Controllers\AuthController@login')->name('auth.register');

