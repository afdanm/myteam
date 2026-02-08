<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Card;
use App\Traits\CardAuthorizable;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;

class CardController extends Controller
{
    use CardAuthorizable;

    /**
     * Display a listing of the resource.
     */
    public function index(Board $board)
    {
        $this->data['board'] = $board;
        $this->data['cards'] = $board->cards;

        return view('cards.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Board $board)
    {
        $this->data['board'] = $board;
        $this->data['action'] = route('boards.cards.store', $board);

        return view('cards.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request, Board $board)
    {
        $board->cards()->create($request->validated());

        return redirect()
            ->route('boards.cards.index', $board)
            ->with('success', 'New Card has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board, Card $card)
    {
        $this->data['board'] = $board;
        $this->data['card'] = $card;
        $this->data['model'] = $card;
        $this->data['action'] = route('boards.cards.update', [$board, $card]);

        return view('cards.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Board $board, Card $card)
    {
        $card->update($request->validated());

        return redirect()
            ->route('boards.cards.index', $board)
            ->with('success', 'Card has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board, Card $card)
    {
        $card->delete();

        return redirect()
            ->route('boards.cards.index', $board)
            ->with('success', 'Card has been deleted!');
    }
}
