<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;

class BoardUserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/auth/boards/{board}/users
     */
    public function index(Board $board)
    {
        return response()->json([
            'success' => true,
            'message' => 'List users in board',
            'data' => $board->users()->get()
        ], 200);
    }

    /**
     * POST /api/auth/boards/{board}/users
     */
    public function store(Request $request, Board $board)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'role'  => 'nullable|string'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($board->users()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User sudah tergabung di board ini.'
            ], 422);
        }

        $role = $validated['role'] ?? 'member';

        $board->users()->attach($user->id, [
            'role' => $role
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan ke board.',
            'data' => [
                'board_id' => $board->id,
                'user_id'  => $user->id,
                'email'    => $user->email,
                'role'     => $role
            ]
        ], 201);
    }

    /**
     * DELETE /api/auth/boards/{board}/users/{user}
     */
    public function destroy(Board $board, User $user)
    {
        if (!$board->users()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ada di board ini.'
            ], 404);
        }

        $board->users()->detach($user->id);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dikeluarkan dari board.'
        ], 200);
    }
}
