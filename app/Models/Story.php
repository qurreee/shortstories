<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['title' ,'body','user_id','cover'];

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'story_id');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_tags', 'story_id', 'genre_id');
    }
    public function likeCount(){
        return $this->likes()->count();
    }

}














