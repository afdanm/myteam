<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/boards
     */
    public function index()
    {
        $user = auth('api')->user();

        if ($user->hasRole('Super Admin')) {
            $boards = Board::all();
        } else {
            $boards = Board::whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })->get();
        }

        return response()->json([
            'success' => true,
            'data' => $boards
        ]);
    }

    /**
     * POST /api/boards
     * HARUS return data yang disubmit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $board = Board::create($validated);

        // attach creator sebagai owner
        $board->users()->attach(auth('api')->id(), [
            'role' => 'owner'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Board created successfully',
            'data' => $validated // return exactly what user submitted
        ], 201);
    }

    /**
     * GET /api/boards/{id}
     */
    public function show(Board $board)
    {
        return response()->json([
            'success' => true,
            'data' => $board
        ]);
    }

    /**
     * PUT /api/boards/{id}
     */
    public function update(Request $request, Board $board)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $board->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Board updated successfully',
            'data' => $validated // return data yang diupdate
        ]);
    }

    /**
     * DELETE /api/boards/{id}
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return response()->json([
            'success' => true,
            'message' => 'Board deleted successfully'
        ]);
    }
}
