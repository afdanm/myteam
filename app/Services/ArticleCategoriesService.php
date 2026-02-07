<?php

namespace App\Services;

/* ---- Define Model ---- */
use App\Models\ArticleCategory;

/* ---- Define Tools ---- */
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ArticleCategoriesService
{
    /**
     * Get all data Article Category from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllArticleCategory()
    {
        return ArticleCategory::where('status', '1')->get();
    }

    /**
     * Store data Article Category to database.
     *
     * @param \App\Http\Requests\StoreArticleCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function insertArticleCategory($request)
    {
        try {
            // Begin Transaction
            DB::beginTransaction();
            ArticleCategory::create($request->all());
            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return true;
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return false;
        }
    }

    /**
     * Update data Article Category to database.
     *
     * @param  \App\Http\Requests\UpdateArticleCategoryRequest  $request
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function updateArticleCategory($request, $articleCategory)
    {
        try {
            // Begin Transaction
            DB::beginTransaction();
            ArticleCategory::where('id',$articleCategory->id)->update($request->except(['_token','_method']));
            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return true;
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return false;
        }
    }

    /**
     * Remove data Article Category specified id from database.
     *
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function removeArticeCategory($articleCategory)
    {
        try {
            // Begin Transaction
            DB::beginTransaction();
            ArticleCategory::where('id',$articleCategory->id)->delete();
            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return true;
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return false;
        }
    }
}
