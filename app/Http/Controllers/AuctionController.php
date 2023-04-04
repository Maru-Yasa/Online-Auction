<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\ItemNotFoundException;

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

        $auction = Auction::all()->where('id', $id)->first();

        if ($auction->status == 'complete') {
            try {            
                $auction = Auction::all()->where('id', $id)->firstOrFail();
                $lastBid = Bid::all()->where('auction_id', $id)->where('offer', $auction->best_offer)->first();
                return view('winner-note', [
                    'winner' => $lastBid->user,
                    'auction' => $auction,
                    'last_bid' => $lastBid
                ]);  
            } catch (ItemNotFoundException $th) {
                return response($th->getMessage(), 404);
            }
        }

        return view('auction.detail', [
            'data' => $auction
        ]);
    }

    public function confirm_winner($auction_id)
    {
        try {            
            $auction = Auction::all()->where('id', $auction_id)->firstOrFail();
            $lastBid = Bid::all()->where('auction_id', $auction_id)->where('offer', $auction->best_offer)->first();
            return view('winner-note', [
                'winner' => $lastBid->user,
                'auction' => $auction,
                'last_bid' => $lastBid
            ]);  
        } catch (ItemNotFoundException $th) {
            return response($th->getMessage(), 404);
        }
    }

    public function confirm_winner_post($auction_id)
    {
        try {            
            $auction = Auction::all()->where('id', $auction_id)->firstOrFail();
            $lastBid = Bid::all()->where('auction_id', $auction_id)->where('offer', $auction->best_offer)->first();
            $auction->update([
                'status' => 'complete',
                'winner' => $lastBid->user->id
            ]);
            return redirect()->route('auctions.index')->with('success', 'Success end the auction');
        } catch (ItemNotFoundException $th) {
            return response($th->getMessage(), 404);
        }
    }

}
