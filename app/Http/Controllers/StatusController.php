<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

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

    public function store()
    {
        $status = auth()->user()->statuses()->create($this->validateRequest());

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

    public function update(Status $status)
    {
        $this->authorize('update', $status);

        $status->update($this->validateRequest());

        return redirect($status->path());
    }

    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);

        $status->delete();

        return redirect("/");
    }

    public function like(Status $status)
    {
        auth()->user()->likes()->toggle($status);

        return redirect($status->path());
    }

    public function reply(Status $status)
    {
        $child = new Status($this->validateRequest());
        $child->user_id = auth()->user()->id;

        $status->replies()->save($child);

        return redirect($status->path());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'body' => 'sometimes|required'
        ]);
    }
}
