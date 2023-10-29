<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }
    public function update(Request $request)
    {

        //update the user's profile information
        $request->user()->forceFill([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'tel' => $request->tel,
            'email' => $request->email,

        ])->save();

//        return redirect()->route('home');
        return view('profile.index', [
            'user' => $request->user(),
        ]);

//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
