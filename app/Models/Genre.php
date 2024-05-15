<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['genre_name'];

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'genre_tags', 'genre_id', 'story_id');
    }
    
}
