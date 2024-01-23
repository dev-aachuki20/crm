<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userDetail = User::where('id', Auth::user()->id)->first();
        $roles = Role::all();
        return view('auth.profile.profile', compact('userDetail', 'roles'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birthdate' => 'required|date_format:Y-m-d',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        $user->update($validatedData);

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
