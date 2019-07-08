<?php

namespace App;

use App\Events\UserEarnedExperience;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'username', 'bio',
        'points'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function path()
    {
        return "/user/{$this->username}";
    }
   
    public function awardExperience($points)
    {
        $this->increment('points', $points);

        UserEarnedExperience::dispatch($this, $points, $this->points);

        return $this;
    }

    public function stripExperience($points)
    {
        $this->decrement('points', $points);

        return $this;
    }

    public function statuses()
    {
        return $this->hasMany(Status::class)->latest('updated_at');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'followed_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'follower_user_id')->withTimestamps();
    }

    public function isFollowed()
    {
        return auth()->user()->following()->where('id', $this->id)->exists();
    }

    public function addFollower($user)
    {
        $follow = $this->followers()->toggle($user);
        
        $this->awardExperience(100);

        return $follow;
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')->withTimestamps();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
