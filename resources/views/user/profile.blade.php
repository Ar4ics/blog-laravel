@extends('layouts.app')

@section('title')
    {{$user->name}}
@endsection

@section('content')

    <div class="column row">
        <div class="media-object">
            <div class="media-object-section">
                <div class="card text-center">
                    <img src="{{asset($user->avatar) }}" style="max-width: 10.0rem;">

                    <h3>{{ $user->name }}</h3>

                </div>
            </div>
            <div class="media-object-section">
                <h4>Краткая информация</h4>
                <div class="callout default">{{$user->info == "" ? "Пока пусто" : $user->info}}</div>
                @if (Auth::id() == $user->id)

                    <div class="column row">
                        <form
                                action="{{action('UserController@storeInfo', ['id' => $user->id])}}" method="POST"
                                accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <label>
                                <textarea name="info" rows="5">{{ old('info') }}</textarea>
                            </label>
                            <button type="submit" class="button success">
                                Сохранить инфу
                            </button>
                        </form>
                        @include('errors.list')
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (Auth::id() == $user->id)
        <form enctype="multipart/form-data" method="POST" action="{{action('UserController@storeAvatar', ['id' => $user->id])}}">
            {{ csrf_field() }}
            <div class="column row">
                <label for="avatar" class="button">Выбрать картинку</label>
                <input type="file" id="avatar" name="avatar" class="show-for-sr">
                <button type="submit" class="button alert">
                    Сохранить
                </button>
            </div>
        </form>
        @include('errors.list')
    @endif



@endsection