<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Card;
use App\Models\ListItem;
use Illuminate\Http\Request;

class ListApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/boards/{board}/cards/{card}/lists
     */
    public function index(Board $board, Card $card)
    {
        if ($card->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found in this board'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $card->lists
        ]);
    }

    /**
     * POST /api/boards/{board}/cards/{card}/lists
     */
    public function store(Request $request, Board $board, Card $card)
    {
        if ($card->board_id !== $board->id) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found in this board'
            ], 404);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $card->lists()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'List created successfully',
            'data' => $validated
        ], 201);
    }

    /**
     * GET /api/boards/{board}/cards/{card}/lists/{list}
     */
    public function show(Board $board, Card $card, ListItem $list)
    {
        if (
            $card->board_id !== $board->id ||
            $list->card_id !== $card->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'List not found in this card'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $list
        ]);
    }

    /**
     * PUT /api/boards/{board}/cards/{card}/lists/{list}
     */
    public function update(Request $request, Board $board, Card $card, ListItem $list)
    {
        if (
            $card->board_id !== $board->id ||
            $list->card_id !== $card->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'List not found in this card'
            ], 404);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $list->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'List updated successfully',
            'data' => $validated
        ]);
    }

    /**
     * DELETE /api/boards/{board}/cards/{card}/lists/{list}
     */
    public function destroy(Board $board, Card $card, ListItem $list)
    {
        if (
            $card->board_id !== $board->id ||
            $list->card_id !== $card->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'List not found in this card'
            ], 404);
        }

        $list->delete();

        return response()->json([
            'success' => true,
            'message' => 'List deleted successfully'
        ]);
    }
}
