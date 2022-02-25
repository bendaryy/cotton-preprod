<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $user = Auth::user();

        $input = $request->except(['avatar', 'password']);

        $user->update($input);

        session()->flash('message', 'Updated Sucessfully');

        return redirect()->back();
    }


}
