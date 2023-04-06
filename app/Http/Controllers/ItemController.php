<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.list', [
            'data' => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'start_price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,gif,jpg'
        ]);

        $data = $request->except(['_token']);

        $image = $request->file('image');
        $filename = Carbon::now()->timestamp.".".explode('/',$image->getClientMimeType())[1];
        $image->move(base_path('public/img/items'), $filename);
        $data['image'] = $filename;

        $item = Item::create($data);

        Auction::create([
            'item_id' => $item->id,
            'user_id' => auth()->user()->id,
            'best_offer' => $item->start_price,
            'status' => 'closed'
        ]);

        return redirect()->route('items.index')->with('success', 'Success adding new data');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', [
            'data' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $withImage = [
            'name' => 'max:255|min:3',
            'start_price' => 'numeric',
            'image' => 'mimes:jpeg,png,gif,jpg'
        ];

        $noImage = [
            'name' => 'max:255|min:3',
            'start_price' => 'numeric',
        ];

        $data = $request->except(['_token']);
        if ($request->file('image')) {
            $request->validate($withImage);
            $image = $request->file('image');
            if (file_exists(base_path('public/img/items/'.$item->image))) {
                unlink(base_path('public/img/items/'.$item->image));                
            }
            $filename = Carbon::now()->timestamp.".".explode('/',$image->getClientMimeType())[1];
            $image->move(base_path('public/img/items'), $filename);
            $data['image'] = $filename;
        }else{
            $request->validate($noImage);
            unset($data['image']);
        }

        $auction = Auction::all()->where('item_id', $item->id)->first();
        if ($auction->status === 'closed') {
            $item->update($data);
            // $auction->update([
            //     'best_offer' => $item->start_price,
            // ]);
        }else{
            return redirect()->route('items.index')->with('error', "Can't edit item while auction open");
        }

        return redirect()->route('items.index')->with('success', 'Success editing data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $auction = Auction::all()->where('item_id', $item->id)->first();
        if ($auction->status == 'closed') {
            unlink(base_path('/public/img/items/'.$item->image));
            $auction->delete();
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Success delete selected item');            
        } else {
            return redirect()->route('items.index')->with('error', "You can't delete an auction while opened in public");
        } 
    }
}
