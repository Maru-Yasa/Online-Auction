<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auction.list', [
            'data' => Auction::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Auction $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        return view('auction.edit', [
            'data' => $auction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auction $auction)
    {
        $data = $request->except("_token");
        $auction->update($data);
        return redirect()->route('auctions.index')->with('success', 'Success edit selected auction');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auction $auction)
    {
        //
    }

    public function detail($id)
    {
        if (!auth()->user()) {
            return redirect('/login');
        }
        return view('auction.detail', [
            'data' => Auction::all()->where('id', $id)->first()
        ]);
    }

}
