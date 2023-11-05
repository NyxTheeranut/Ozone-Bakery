<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's profile
        $user = auth()->user(); // Assuming you are using authentication

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }

    public function getUserData(Request $request)
    {
        $user = $request->user(); // Assuming you want to fetch the authenticated user's data

        return response()->json([
            'user' => $user,
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'User not found.');
        }

        if ($request->wantsJson()) {
            // For API requests, return JSON data
            return response()->json($user);
        }

        // For web requests, return a view
        return view('user.profile', ['user' => $user]);
    }

    public function getUserProfile()
    {
        $user = auth()->user(); // Assuming you are using authentication
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:3|max:256',
            'lastname'  => 'required|min:3|max:256',
            'tel'   => 'required|string|size:10|regex:/^[0-9]+$/',
            'email' => 'required|email',
            'password'  => 'required|string|min:8',
            'is_admin'  => 'nullable|boolean'
        ]);

        $user = new User();

        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->tel = $request->get('tel');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->is_admin = $request->get('is_admin');

        $user->save();
        $user->refresh();
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'nullable|min:3|max:256',
            'lastname'  => 'nullable|min:3|max:256',
            'tel'   => 'nullable|string|size:10|regex:/^[0-9]+$/',
            'email' => 'nullable|email',
            'email_verified_at' => 'nullable|date',
            'password'  => 'nullable|string|min:8',
            'is_admin'  => 'nullable|boolean'
        ]);

        if ($request->has('name')) $user->name = $request->get('name');
        if ($request->has('lastname')) $user->lastname = $request->get('lastname');
        if ($request->has('tel')) $user->tel = $request->get('tel');
        if ($request->has('email')) $user->email = $request->get('email');
        if ($request->has('email_verified_at')) $user->email_verified_at = $request->get('email_verified_at');
        if ($request->has('password')) $user->password = $request->get('password');
        if ($request->has('is_admin')) $user->is_admin = $request->get('is_admin');

        $user->save();
        $user->refresh();
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return ["message" => "delete successfully"];
    }
}
