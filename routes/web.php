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
Route::get('/', 'App\Http\Controllers\HomeController@welcome')->name('welcome');
Route::get('/auction/{id}/detail', 'App\Http\Controllers\AuctionController@detail')->name('item_detail');

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function(){
    Route::get('/', 'App\Http\Controllers\HomeController@view')->name('home');
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('users', 'App\Http\Controllers\UserController');
        Route::resource('logs', 'App\Http\Controllers\LogController');
    });
    Route::group(['middleware' => 'staff'], function(){
        Route::resource('items', 'App\Http\Controllers\ItemController');
        Route::resource('auctions', 'App\Http\Controllers\AuctionController');
        Route::resource('bids', 'App\Http\Controllers\BidController');
        Route::get('/auction/{auction_id}/confirm_winner', 'App\Http\Controllers\AuctionController@confirm_winner')->name('auctions.confirm_winner');
        Route::get('/auction/{auction_id}/post_confirm_winner', 'App\Http\Controllers\AuctionController@confirm_winner_post')->name('auctions.post_confirm_winner');
    });
    
    Route::get('/profile', 'App\Http\Controllers\ProfileController@view')->name('profile');
    
    Route::get('/bestBidAjax', 'App\Http\Controllers\BidController@best_bid')->name('best_bid');
    Route::get('/auction/{id}/detail', 'App\Http\Controllers\AuctionController@detail')->name('auctions.detail');
});

Route::group(['middleware' => 'client'], function(){
    Route::post('/place_bid', 'App\Http\Controllers\BidController@place_bid')->name('place_bid');
});

// Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
// Route::get('/register', 'App\Http\Controllers\AuthController@login')->name('auth.register');

