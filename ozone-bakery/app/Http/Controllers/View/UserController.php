<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user(); // Example: Get the currently authenticated user

        return view('profile.index', compact('user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'name'  => 'nullable|min:3|max:256|regex:/^[\p{L}\s]+$/u',
            'lastname'  => 'nullable|min:3|max:256|regex:/^[\p{L}\s]+$/u',
            'tel'   => 'nullable|string|size:10|regex:/^\d+$/',
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
