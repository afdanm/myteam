<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/auth/boards/{board}/chat
     */
    public function index(Board $board)
    {
        return response()->json([
            'success' => true,
            'data' => $board->chats()->latest()->get()
        ]);
    }

    /**
     * POST /api/auth/boards/{board}/chat
     */
    public function store(Request $request, Board $board)
    {
        $validated = $request->validate([
            'nama'  => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $chat = $board->chats()->create([
            'nama'  => $validated['nama'],
            'pesan' => $validated['pesan'],
            'ip'    => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chat berhasil dikirim',
            'data' => $chat
        ], 201);
    }

    /**
     * GET /api/auth/boards/{board}/chat/{chat}
     */
    public function show(Board $board, Chat $chat)
    {
        if ($chat->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Chat tidak ditemukan di board ini'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $chat
        ]);
    }

    /**
     * DELETE /api/auth/boards/{board}/chat/{chat}
     */
    public function destroy(Board $board, Chat $chat)
    {
        if ($chat->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Chat tidak ditemukan di board ini'
            ], 404);
        }

        $chat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chat berhasil dihapus'
        ]);
    }
}
