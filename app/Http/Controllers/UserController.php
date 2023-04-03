<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.list', [
            'data' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'unique:users,username|required|alpha_dash',
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        // dd($data);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Success add new user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'unique:users,username,'.$user->id.'|required|alpha_dash',
            'name' => 'required',
            'role' => 'required'
        ]);
        $data = $request->except('_token');
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        // dd($data);
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Success edit user');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users.index')->with('error', "You can't delete yourself");
        }else{
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Success delete user');
        }
    }
}
