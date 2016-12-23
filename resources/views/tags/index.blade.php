@extends('layouts.app')

@section('title', 'Все теги')

@section('content')
    <div class="column row">
        @foreach($tags as $tag)
                <p>
                    <a href="{{ action('TagController@show', ['name' => $tag->name]) }}">
                        {{ $tag->name }}
                    </a> -
                    <span class="badge large">{{ $tag->articles->count() }}</span>
                </p>
        @endforeach
    </div>

@endsection
