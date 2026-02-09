<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'nama',
        'pesan',
        'ip',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
