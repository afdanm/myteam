<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['board_id', 'name'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function lists()
    {
        return $this->hasMany(ListItem::class);
    }

}
