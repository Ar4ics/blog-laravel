<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->articles()->with('user')->orderBy('created_at', 'desc')->get();
        return $posts;
        //return view('posts.index', compact('posts', 'tag'));

    }

    public function index()
    {
        $tags = Tag::withCount('articles')->orderBy('articles_count', 'desc')->get();

        //$tags = Tag::withCount('articles')->sortBy(function ($count));
        return $tags;
        //return view('tags.index', compact('tags'));

    }
}
