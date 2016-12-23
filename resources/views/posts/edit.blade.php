@extends('layouts.app')

@section('title', 'Редактировать статью')
@section('content')
    <form action="{{action('PostController@update', ['slug' => $post->slug])}}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="column row">
            <label>Тема
                <input type="text" name="title" value="{{ $post->title }}"/>
            </label>
        </div>
        <div class="column row">
            <label> Контент
                <textarea name="content" rows="5">{{ $post->content }}</textarea>
            </label>
        </div>
        <div class="column row">
            <label>Выбрать теги
                <select multiple name="tags[]">
                    @foreach($tags as $key => $value)
                        <option {{ in_array($key, $tag_list) ? 'selected' : ''}} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="column row">
            <button class="button" type="submit">Сохранить изменения</button>
        </div>
        <div class="column row">
            @include('errors.list')
        </div>
    </form>

@endsection
