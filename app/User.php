<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'username', 'bio'
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

    public function experience()
    {
        return $this->hasOne(Experience::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class)->latest('updated_at');
    }

    public function likes()
    {
        return $this->belongsToMany(Status::class, 'likes');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'followed_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'follower_user_id');
    }

    public function isFollowed()
    {
        return auth()->user()->following()->where('id', $this->id)->exists();
    }

    public function addFollower($user)
    {
        $follow = $this->followers()->toggle($user);
        
        auth()->user()->experience->awardExperience(100);

        return $follow;
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')->withTimestamps();
    }
}
