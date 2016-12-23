@extends('layouts.app')

@section('title')
    {{ $tag or "Все посты" }}
@endsection

@section('content')
    @if (Auth::check())
        <div class="column row">
            <a href="{{ url('posts/create') }}" class="button">
                Добавить пост
            </a>
        </div>
    @endif
    <div class="column row">
        <h3 class="text-center">{{ $tag or "Все посты" }}</h3>
    </div>
    @foreach ($posts as $post)


        <div class="row">
            <div class="medium-9 columns">
                <div class="column row">
                    <div class="medium-12 columns">
                        <a href="{{action('PostController@show', $post->slug)}}">
                            {{ $post->title }}
                        </a>
                    </div>
                </div>
                <div class="column row">
                    <div class="medium-12 columns">
                        <p class="text-justify">{{str_limit($post->content, 100)}}</p>
                        <div class="align-self-bottom">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="medium-3 columns" style="width: 100px;">
                <div
                        onclick="window.location='{{ action('UserController@show', ['name' => $post->user->name]) }}'"
                        class="text-center">
                    <img src="{{asset($post->user->avatar) }}" alt="Avatar">
                    <span>{{ $post->user->name }}</span>
                </div>
            </div>
        </div>
        <div class="column row">
            <hr>
        </div>

    @endforeach



@endsection