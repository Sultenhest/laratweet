<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Status;
use Illuminate\Http\Request;
use App\Events\StatusCreated;
use App\Events\StatusDeleted;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = auth()->user()->statuses;

        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $status = auth()->user()->statuses()->create($this->validateRequest());

        $this->syncTags($request, $status);

        auth()->user()->awardExperience(100);

        return redirect($status->path());
    }

    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $this->authorize('update', $status);

        $status->update($this->validateRequest());

        $this->syncTags($request, $status);

        return redirect($status->path());
    }

    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);

        $status->delete();

        auth()->user()->stripExperience(100);

        return redirect("/");
    }

    public function pin(Status $status)
    {
        $this->authorize('update', $status);

        $status->togglePin();

        return redirect($status->path());
    }

    public function like(Status $status)
    {
        $status->toggleLike();

        return redirect($status->path());
    }

    public function reply(Status $status)
    {
        $reply = new Status($this->validateRequest());
        $reply->user_id = auth()->id();

        $status->replies()->save($reply);
        
        auth()->user()->awardExperience(100);

        return redirect($status->path());
    }

    private function syncTags(Request $request, Status $status)
    {
        $tagsId = collect($request->input('tags'))->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $status->tags()->sync($tagsId);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'body' => 'sometimes|required',
            'tags' => 'sometimes|required'
        ]);
    }
}
