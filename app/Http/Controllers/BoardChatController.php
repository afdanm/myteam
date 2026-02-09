<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardChatController extends Controller
{
    public function index(Board $board)
    {
        return view('boards.chat', compact('board'));
    }

    public function store(Request $request, Board $board)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        $nama = auth()->check()
            ? auth()->user()->username
            : $request->nama;

        $chat = $board->chats()->create([
            'nama' => $nama,
            'pesan' => $request->pesan,
            'ip' => $request->ip(),
        ]);

        return response()->json($chat);
    }

    public function fetch(Board $board)
    {
        return $board->chats()
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();
    }
}
