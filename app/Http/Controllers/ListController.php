<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Card;
use App\Models\ListItem;
use App\Traits\ListAuthorizable;
use App\Http\Requests\StoreListRequest;
use App\Http\Requests\UpdateListRequest;

class ListController extends Controller
{
    use ListAuthorizable;
    public function index(Board $board, Card $card)
    {
        $this->data['board'] = $board;
        $this->data['card']  = $card;
        $this->data['lists'] = $card->lists;

        return view('lists.index', $this->data);
    }

    public function create(Board $board, Card $card)
    {
        $this->data['board']  = $board;
        $this->data['card']   = $card;
        $this->data['action'] = route('boards.cards.lists.store', [$board, $card]);

        return view('lists.form', $this->data);
    }

    public function store(StoreListRequest $request, Board $board, Card $card)
    {
        $card->lists()->create($request->validated());

        return redirect()
            ->route('boards.cards.lists.index', [$board, $card])
            ->with('success', 'New List has been created!');
    }

    public function edit(Board $board, Card $card, ListItem $list)
    {
        $this->data['board'] = $board;
        $this->data['card']  = $card;
        $this->data['list']  = $list;
        $this->data['model'] = $list;
        $this->data['action'] = route('boards.cards.lists.update', [$board, $card, $list]);

        return view('lists.form', $this->data);
    }

    public function update(UpdateListRequest $request, Board $board, Card $card, ListItem $list)
    {
        $list->update($request->validated());

        return redirect()
            ->route('boards.cards.lists.index', [$board, $card])
            ->with('success', 'List has been updated!');
    }

    public function destroy(Board $board, Card $card, ListItem $list)
    {
        $list->delete();

        return back()->with('success', 'List has been deleted!');
    }
}
