@extends('layouts.app')

@section('content')


    <form method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="medium-1 medium-offset-3 small-2  columns">
                <label for="email" class="middle">Почта</label>
            </div>
            <div class="medium-5 columns small-10 end">
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="medium-1 medium-offset-3 small-2 columns">
                <label for="password" class="middle">Пароль</label>
            </div>
            <div class="medium-5 columns small-10 end">
                <input type="password" id="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="column row">
            <fieldset class="medium-3 medium-offset-3">
                <input id="remember" type="checkbox" name="remember"><label for="remember">Запомни меня</label>
            </fieldset>
        </div>
        <div class="column row">

            <div class="medium-3 medium-offset-3 small-12">
                <input type="submit" class="button" value="Зайти">
                <a class="button" href="{{ url('password/reset') }}">
                    Забыли пароль?
                </a>
            </div>
        </div>
    </form>

@endsection
