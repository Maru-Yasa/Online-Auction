<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    
    public function index()
    {
        return view('report');
    }

    public function generate(Request $request)
    {
        if ($request->input('method') == 'by_date' && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                'from' => 'before_or_equal:to|date|required',
                'to' => 'after_or_equal:from|date|required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'messages' => $validator->errors(),
                    'data' => []
                ]);
            }
            $from = $request->from;
            $to = $request->to;
            $parsedFrom = Carbon::parse($from)->subDays(1);
            $parsedTo = Carbon::parse($to)->addDays(1);
            $auction = Auction::all()->whereBetween('created_at', [$parsedFrom, $parsedTo]);
            return response([
                'status' => true,
                'message' => 'success',
                'data' => view('report-doc', [
                    'data' => $auction,
                    'from' => $from,
                    'to' => $to
                ])->render()
            ]);
        }
    }

    public function doc(Request $request)
    {
        if ($request->query('method') == 'by_date') {
            $from = $request->query('from');
            $to = $request->query('to'); 
            $auction = Auction::all()->whereBetween('created_at', [$from, $to]);
            return view('report-doc', [
                'data' => $auction,
                'from' => $from,
                'to' => $to
            ]);
        }
    }

}
