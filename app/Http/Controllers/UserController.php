<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        // $user = User::findOrFail(auth()->user()->id);

        // $user->name = $request->name;
        // $user->email = $request->email;
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user->save();
        return redirect()->route('web.user.show', ['user' => $user->id])->with('message', 'User Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
