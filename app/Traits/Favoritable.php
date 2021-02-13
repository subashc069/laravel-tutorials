<?php

namespace App\Traits;

use App\Models\Favorite;

trait Favoritable

{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {   
        $attributes = ['user_id' => auth()->id()];
        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}