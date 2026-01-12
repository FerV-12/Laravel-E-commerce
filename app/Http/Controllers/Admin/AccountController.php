<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.accounts.index', compact('users'));
    }

    public function destroy($id)
    {
        // Prevent deleting the currently authenticated user
        if (auth()->check() && auth()->id() == $id) {
            return redirect('admin/accounts')->with('status', 'You cannot delete your own account.');
        }

        $user = User::find($id);

        if (! $user) {
            return redirect('admin/accounts')->with('status', 'Account not found.');
        }

        $user->delete();

        return redirect('admin/accounts')->with('status', 'Account deleted successfully.');
    }
}
