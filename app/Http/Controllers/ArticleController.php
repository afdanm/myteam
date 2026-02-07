<?php

namespace App\Http\Controllers;

use App\Traits\ArticlesAuthorizable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ArticleController extends Controller
{

    use ArticlesAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['articles'] = Article::all();

        return view('article.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = ArticleCategory::all();
        $this->data['action'] = "/article";
        return view('article.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        if (isset($request['highlite'])) {
            $request['highlite'] = true;
        } else {
            $request['highlite'] = false;
        }

        $request['image_path'] = $request->file('image')->store('article-images');
        $request['published_at'] = date('Y-m-d', strtotime($request->published_at));
        $request['user_id'] = auth()->user()->id;
        $request['excerpt'] = Str::limit(strip_tags($request->content), 200);

        Article::create($request->all());

        return redirect('article')->with('success', 'New article has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $this->data['article_data'] = $article;
        return view('article.detail', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->data['categories'] = ArticleCategory::all();

        $this->data['article_data'] = $article;
        $this->data['action'] = "/article/" . $article->slug;

        return view('article.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        if (isset($request['highlite'])) {
            $request['highlite'] = true;
        } else {
            $request['highlite'] = false;
        }

        if ($request->file('image')) {
            if ($article->image_path) {
                Storage::delete($article->image_path);
            }
            $request['image_path'] = $request->file('image')->store('article-images');
        }
        $request['published_at'] = date('Y-m-d', strtotime($request->published_at));
        $request['excerpt'] = Str::limit(strip_tags($request->content), 200);
        if ($request->title != $article->title) {
            $request['slug'] = SlugService::createSlug(Article::class, 'slug', $request->title);
        }

        Article::find($article->id)->update($request->all());

        return redirect('article')->with('success', 'Article ' . $article->title . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        if ($article->image_path) {
            Storage::delete($article->image_path);
        }
        return redirect('/article')->with('success', 'Article ' . $article->title . ' has been deleted!');
    }
}
