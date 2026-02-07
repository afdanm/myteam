<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Article;

class ArticleCategory extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function article()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
