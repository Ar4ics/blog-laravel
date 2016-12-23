@extends('layouts.app')

@section('title'){{ $post->title }}@endsection

@section('content')
    @can('update-post', $post)
        <div class="column row">
            <a class="button"
               href="{{action('PostController@edit', ['slug' => $post->slug])}}">
                Изменить пост
            </a>
        </div>
    @endcan
    <div class="column row">
        <h3>
            {{ $post->title }}
        </h3>
    </div>
    <div class="column row">
        <h5 class="text-justify">{{ $post->content }}</h5>
    </div>

    <div class="column row">
        @foreach($post->tags as $tag)
            <a href="{{action('TagController@show', ['name' => $tag->name])}}"
               class="label success">{{ $tag->name }}</a>
        @endforeach
    </div>

    <div class="column row">
        <p></p>
    </div>

    @if ($post->comments->count() > 0)
        @foreach ($post->comments as $comment)

            <div class="column row">
                <div class="media-object">
                    <div class="media-object-section">
                        <div
                                onclick="window.location='{{ action('UserController@show', ['name' => $comment->user->name]) }}'"
                                class="card text-center"
                                style="width: 90px;">
                            <img src="{{asset($comment->user->avatar) }}" style="width: 50px;">

                            <span>{{ $comment->user->name }}</span>

                        </div>
                    </div>
                    <div class="media-object-section text-justify">
                        <div>
                            <p>{{$comment->comment}}</p>
                            <span>{{$comment->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

    <div class="column row">
        <form
                action="{{action('PostController@storeComment', ['slug' => $post->slug])}}" method="POST"
                accept-charset="UTF-8">
            {{ csrf_field() }}
            <label>
                <textarea name="comment" rows="5">{{ old('comment') }}</textarea>
            </label>
            <button type="submit" class="button">
                Добавить комментарий
            </button>
        </form>
        @include('errors.list')
    </div>

@endsection
