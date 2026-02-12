<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardChatApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['fetch']);
    }

    /**
     * GET /api/boards/{board}/chat
     * Ambil 50 chat terakhir
     */
    public function index(Board $board)
    {
        $chats = $board->chats()
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return response()->json([
            'success' => true,
            'data' => $chats
        ]);
    }

    /**
     * POST /api/boards/{board}/chat
     */
    public function store(Request $request, Board $board)
    {
        $validated = $request->validate([
            'pesan' => 'required|string',
            'nama'  => 'nullable|string|max:255'
        ]);

        $nama = auth('api')->check()
            ? auth('api')->user()->username
            : ($validated['nama'] ?? 'Guest');

        $chat = $board->chats()->create([
            'nama'  => $nama,
            'pesan' => $validated['pesan'],
            'ip'    => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $chat
        ], 201);
    }

    /**
     * GET /api/boards/{board}/chat/fetch
     */
    public function fetch(Board $board)
    {
        $chats = $board->chats()
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return response()->json([
            'success' => true,
            'data' => $chats
        ]);
    }
}
