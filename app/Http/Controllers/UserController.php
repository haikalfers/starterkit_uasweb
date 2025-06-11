<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // ambil semua user
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,wartawan'
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('status', 'Role user berhasil diubah.');
    }
}
