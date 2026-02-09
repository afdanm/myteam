<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    protected $table = 'lists';
    protected $fillable = ['card_id', 'content'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
