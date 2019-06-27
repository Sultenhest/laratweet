<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $statuses = $tag->statuses()->latest()->paginate(2);
        return view('tags.show', compact('tag', 'statuses'));
    }
}
