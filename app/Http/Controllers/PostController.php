<?php

namespace App\Http\Controllers;
use App\Article;
use App\Tag;
use App\Comment;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    public function show(Article $post)
    {
        return $post;
        //return view('posts.post', compact('post'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->pluck('name', 'id');
        return view('posts.create', compact('tags'));
    }

    public function edit(Article $post)
    {
        $tags = Tag::orderBy('name')->pluck('name', 'id');
        $tag_list = $post->getTagListAttribute();
        return view('posts.edit', ['post' => $post, 'tags' => $tags, 'tag_list' => $tag_list]);

    }

    public function index()
    {
        return Article::with('user')->latest()->get();
        //$posts = Article::latest()->get();
        //return view('posts.index', compact('posts'));
    }

    public function storeComment(CommentRequest $request, $slug)
    {
        $post = Article::where('slug', $slug)->firstOrFail();
        $comment = new Comment;
        $comment->article_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->action('PostController@show', compact('slug'));


    }

    public function store(PostRequest $request) {

        $post = Auth::user()->articles()->create($request->all());
        $post->tags()->attach($request->input('tags'));

        Session::flash('status', 'Пост создан!');
        return redirect()->action('PostController@index');

    }

    public function update(PostRequest $request, Article $post) {

        if (Gate::denies('update-post', $post)) {
            abort(403);
        }
        $post->update($request->all());
        $post->tags()->sync($request->input('tags'));
        Session::flash('status', 'Пост был обновлен!');
        return redirect('posts');

    }
}
