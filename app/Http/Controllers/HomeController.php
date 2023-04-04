<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view()
    {
        if (auth()->user()->role === 'client') {
            $bids_history = Bid::orderBy('created_at', 'DESC')->where('user_id', auth()->user()->id)->get();
            $win_history = Auction::all()->where('winner', auth()->user()->id);
            return view('index-client', $data=[
                'user' => auth()->user(),
                'message' => 'test',
                'total_bid' => Bid::all()->where('user_id', auth()->user()->id)->count(),
                'spent' => Bid::all()->where('user_id', auth()->user()->id)->sum('offer'),
                'bids_history' => $bids_history,
                'win_history' => $win_history
            ]);
        }
        return view('index', $data=[
            'auctions_count' => Auction::all()->count(),
            'bids_count' => Bid::all()->count(),
            'items_count' => Item::all()->count(),
            'users_count' => User::all()->count(),
            'sum_bid' => Bid::all()->sum('offer')
        ]);
    }

    public function welcome()
    {
        return view('welcome', [
            'data' => Auction::orderBy('created_at', 'DESC')->get()->where('status', 'open')
        ]);
    }

}
