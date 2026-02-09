<?php

namespace App\Http\Controllers;

use App\Traits\BoardAuthorizable;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\updateBoardRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;


class BoardController extends Controller
{
    use BoardAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
    $user = auth()->user();

    if ($user->hasRole('Super Admin')) {
        $this->data['boards'] = Board::all();
    } else {
        $this->data['boards'] = Board::whereHas('users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })->get();
    }

    return view('boards.index', $this->data);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['action'] = "/boards";
        return view('boards.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $board = Board::create($request->validated());

        // attach creator sebagai owner
        $board->users()->attach(auth()->id(), [
            'role' => 'owner'
        ]);

        return redirect()
            ->route('boards.index')
            ->with('success', 'New Board has been created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        $this->data['boards'] = $board;
        $this->data['action'] = "/boards/" . $board->slug;
        $this->data['model'] = $board;
        return view('boards.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoardRequest  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        if ($request->name != $board->name) {
            $request['slug'] = SlugService::createSlug(Board::class, 'slug', $request->name);
        }

        Board::find($board->id)
            ->update($request->all());

        return redirect('/boards')->with('success', 'Board has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return redirect('/boards')->with('success', 'Board has been Deleted!');
    }
}
