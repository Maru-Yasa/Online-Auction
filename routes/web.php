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
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('users', 'App\Http\Controllers\UserController');
    });
    Route::group(['middleware' => 'staff'], function(){
        Route::get('/', 'App\Http\Controllers\HomeController@view')->name('home');
        Route::get('/auction/{id}/detail', 'App\Http\Controllers\AuctionController@detail')->name('auction.detail');
        Route::resource('items', 'App\Http\Controllers\ItemController');
        Route::resource('auctions', 'App\Http\Controllers\AuctionController');
    });
    Route::get('/profile', 'App\Http\Controllers\ProfileController@view')->name('profile');

    Route::get('/bestBidAjax', 'App\Http\Controllers\BidController@best_bid')->name('best_bid');
});

// Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
// Route::get('/register', 'App\Http\Controllers\AuthController@login')->name('auth.register');

