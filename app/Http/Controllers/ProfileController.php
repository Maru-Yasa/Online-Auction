<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view()
    {
        return view('profile', $data=[
            'user' => auth()->user(),
            'message' => 'test'
        ]);
    }
}
