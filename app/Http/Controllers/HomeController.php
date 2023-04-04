<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view()
    {
        if (auth()->user()->role === 'client') {
            return view('profile', $data=[
                'user' => auth()->user(),
                'message' => 'test'
            ]);
        }
        return view('index', $data=[
            'auctions_count' => 0,
            'bids_count' => 0,
            'items_count' => 0,
            'users_count' => 0
        ]);
    }

    public function welcome()
    {
        return view('welcome', [
            'data' => Auction::orderBy('created_at', 'DESC')->get()->where('status', 'open')
        ]);
    }

}
