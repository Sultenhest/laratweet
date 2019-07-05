<?php

namespace App;

use App\User;
use App\Events\UserLikedAStatus;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use Likeable, RecordsActivity;

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
            //$this->recordActivity('pinned');
        }
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
}
