<?php

namespace App\Http\Controllers;

use App\Traits\ArticleCategoriesAuthorizable;
use App\Models\ArticleCategory;
use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;


class ArticleCategoryController extends Controller
{
    use ArticleCategoriesAuthorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['articleCategories'] = ArticleCategory::where('status', '1')->get();
        return view('article_categories.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['action'] = "/article_categories";
        return view('article_categories.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleCategoryRequest $request)
    {
        ArticleCategory::create($request->all());

        return redirect('article_categories')->with('success', 'New Category has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $articleCategory)
    {
        $this->data['article_categories_data'] = $articleCategory;
        $this->data['action'] = "/article_categories/" . $articleCategory->slug;
        $this->data['model'] = $articleCategory;
        return view('article_categories.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleCategoryRequest  $request
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        if ($request->name != $articleCategory->name) {
            $request['slug'] = SlugService::createSlug(ArticleCategory::class, 'slug', $request->name);
        }

        ArticleCategory::find($articleCategory->id)
            ->update($request->all());

        return redirect('/article_categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        ArticleCategory::find($articleCategory->id)
            ->update(['status' => FALSE]);

        return redirect('/article_categories')->with('success', 'Category has been Deleted!');
    }
}
