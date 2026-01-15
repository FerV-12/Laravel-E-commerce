<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile')) {
            $filename = time().'.'.$request->profile->extension();
            $request->profile->move(public_path('profiles'), $filename);
            $user->profile = $filename;
        }

        $user->save();

        return back()->with('success', 'Account updated successfully!');
    }
}
