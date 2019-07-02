<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('statuses')
            ->orderBy('statuses_count', 'desc')
            ->get();
        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $statuses = $tag->statuses()->latest()->paginate(20);
        return view('tags.show', compact('tag', 'statuses'));
    }
}
