<?php

namespace App\Http\Controllers;

use App\User;
use App\Achievement;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $statuses = $user->statuses;

        $followers = $user->followers;
        $following = $user->following;

        $achievements = Achievement::all();
        $awarded_achievements = $user->achievements;

        return view('users.show', compact('user', 'statuses', 'followers', 'following', 'achievements', 'awarded_achievements'));
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
