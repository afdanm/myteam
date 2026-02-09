<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;

class BoardUserController extends Controller
{
    public function index(Board $board)
    {
        $users = $board->users;

        return view('boards.users.index', compact('board', 'users'));
    }

    public function store(Request $request, Board $board)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($board->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User sudah tergabung di board ini.');
        }

        $board->users()->attach($user->id);

        return back()->with('success', 'User berhasil ditambahkan ke board.');
    }

    public function destroy(Board $board, User $user)
    {
        if (!$board->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User tidak ada di board ini.');
        }

        $board->users()->detach($user->id);

        return back()->with('success', 'User berhasil dikeluarkan dari board.');
    }
}
