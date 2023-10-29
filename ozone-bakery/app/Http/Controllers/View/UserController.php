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

        $request->validate([
            'name'  => 'nullable|min:3|max:256|regex:/^[a-zA-Z]+$/',
            'lastname'  => 'nullable|min:3|max:256|regex:/^[a-zA-Z]+$/',
            'tel'   => 'nullable|string|size:10|regex:/^[0-9]+$/',
            'email' => 'nullable|email',
            'email_verified_at' => 'nullable|date',
            'password'  => 'nullable|string|min:8',
            'is_admin'  => 'nullable|boolean'
        ]);

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
