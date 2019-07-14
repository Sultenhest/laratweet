<?php

namespace App;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function like()
    {
        $attributes = ['user_id' => auth()->id()];
        
        if (! $this->likes()->where($attributes)->exists()) {
            auth()->user()->awardExperience(10);

            return $this->likes()->create($attributes);
        }
    }

    public function unlike()
    {
        $attributes = ['user_id' => auth()->id()];
        
        if ($this->likes()->where($attributes)->exists()) {
            auth()->user()->stripExperience(10);

            return $this->likes()->where($attributes)->get()->each->delete();
        }
    }

    public function isLiked()
    {
        return !! $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function likesCount()
    {
        return $this->likes->count();
    }
} 