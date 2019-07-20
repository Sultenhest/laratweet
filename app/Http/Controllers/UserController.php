<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Activity;
use App\Achievement;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'statuses' => $user->statuses,
            'tags' => Tag::all(),
            'activities' => Activity::feed([$user->id]),
            'followers' => $user->followers,
            'following' => $user->following,
            'achievements' => Achievement::all(),
            'awarded_achievements' => $user->achievements
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user);

        $user->update($this->validateRequest());

        return redirect($user->path());
    }

    public function follow(User $user)
    {
        $this->authorize('canFollow', $user);
        
        $user->addFollower(auth()->user());
       
        return redirect($user->path());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'bio' => 'sometimes|required'
        ]);
    }
}
