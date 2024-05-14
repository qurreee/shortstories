<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreTag extends Model
{
    use HasFactory;
    protected $fillable = ['story_id', 'genre_id'];

    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
