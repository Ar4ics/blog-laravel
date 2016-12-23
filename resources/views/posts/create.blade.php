@extends('layouts.app')

@section('title', 'Накатать пост')

@section('content')
    <form action="{{action('PostController@store')}}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="column row">
            <label>Тема
                <input type="text" name="title" value="{{ old('title') }}"/>
            </label>
        </div>
        <div class="column row">
            <label> Контент
                <textarea name="content" rows="5">{{ old('content') }}</textarea>
            </label>
        </div>
        <div class="column row">
            <label>Выбрать теги
                <select multiple name="tags[]">
                    @foreach($tags as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="column row">
            <button class="button" type="submit">Добавить</button>
        </div>
        <div class="column row">
            @include('errors.list')
        </div>
    </form>

@endsection

