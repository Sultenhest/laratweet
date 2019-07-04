<?php

namespace App;

use App\User;
use App\Events\UserLikedAStatus;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'body', 'pinned'
    ];

    protected $casts = [
        'pinned' => 'boolean'
    ];

    public function path()
    {
        return "/status/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function togglePin()
    {
        $this->update([
            'pinned' => ! $this->pinned
        ]);

        if ($this->pinned) {
            $this->recordActivity('pinned');
        }
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function toggleLike()
    {
        $like = $this->likes()->toggle(auth()->id());
        
        auth()->user()->awardExperience(100);

        $this->recordActivity('added_like');

        return $like;
    }

    public function isLiked()
    {
        return auth()->user()->likes()->where('id', $this->id)->exists();
    }

    public function parent()
    {
        return $this->belongsTo(Status::class);
    }

    public function replies()
    {
        return $this->hasMany(Status::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function recordActivity($description)
    {
        $this->activity()->create(compact('description'));
    }
}
