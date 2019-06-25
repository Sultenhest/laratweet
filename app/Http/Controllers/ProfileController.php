<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Profile $profile)
    {
        $this->authorize('update', $profile);

        $profile->update($this->validateRequest());

        return redirect($profile->path());
    }

    public function follow(Profile $profile)
    {
        $this->authorize('canFollow', $profile);

        $user = $profile->user;

        auth()->user()->following()->toggle($user);

        return redirect($profile->path());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'sometimes|required',
            'bio' => 'sometimes|required'
        ]);
    }
}
