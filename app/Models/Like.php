<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'story_id', 'like'];

    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
