<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsFavorites extends Model
{
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'news_favorites')
            ->withPivot('is_read', 'is_archived')
            ->withTimestamps();
    }

}
