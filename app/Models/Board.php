<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Card;
use App\Models\User;
use App\Models\Chat;

class Board extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
