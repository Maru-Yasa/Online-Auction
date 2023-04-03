<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view()
    {
        return view('index', $data=[
            'auctions_count' => 0,
            'bids_count' => 0,
            'items_count' => 0,
            'users_count' => 0
        ]);
    }
}
