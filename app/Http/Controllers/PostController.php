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
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }


    public function show(Article $post)
    {
        return $post;
        //return view('posts.post', compact('post'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->pluck('name', 'id');
        //return view('posts.create', compact('tags'));
        return $tags;
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

    public function storeComment(Request $request, $slug)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:50',
        ]);
        $post = Article::where('slug', $slug)->firstOrFail();
        $comment = new Comment;
        $comment->article_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json(['comment' => $comment->with('user')->orderBy('created_at', 'desc')->first()]);

        //return redirect()->action('PostController@show', compact('slug'));


    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:5|max:30',
            'content' => 'required',
            'tags' => 'required|max:3'
        ]);
        $post = Auth::user()->articles()->create($request->all());
        $post->tags()->attach($request->input('tags'));
        return response()->json(['slug' => $post->slug]);

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
