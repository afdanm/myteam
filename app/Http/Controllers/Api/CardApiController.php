<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Card;
use Illuminate\Http\Request;

class CardApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/boards/{board}/cards
     */
    public function index(Board $board)
    {
        return response()->json([
            'success' => true,
            'data' => $board->cards()->latest()->get()
        ]);
    }

    /**
     * POST /api/boards/{board}/cards
     */
    public function store(Request $request, Board $board)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $card = $board->cards()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Card created successfully',
            'data' => $card   // ✅ return full object dari DB
        ], 201);
    }

    /**
     * GET /api/boards/{board}/cards/{card}
     */
    public function show(Board $board, Card $card)
    {
        if ($card->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found in this board'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $card
        ]);
    }

    /**
     * PUT /api/boards/{board}/cards/{card}
     */
    public function update(Request $request, Board $board, Card $card)
    {
        if ($card->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found in this board'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $card->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Card updated successfully',
            'data' => $card->fresh() // ✅ ambil data terbaru dari DB
        ]);
    }

    /**
     * DELETE /api/boards/{board}/cards/{card}
     */
    public function destroy(Board $board, Card $card)
    {
        if ($card->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found in this board'
            ], 404);
        }

        $card->delete();

        return response()->json([
            'success' => true,
            'message' => 'Card deleted successfully',
            'data' => $card   // optional: return data sebelum delete
        ]);
    }
}
