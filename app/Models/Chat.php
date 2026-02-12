<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'board_id',
        'nama',
        'pesan',
        'ip',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
