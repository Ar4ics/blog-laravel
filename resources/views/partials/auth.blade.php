@if (Auth::guest())

    <li><a href="{{ url('login') }}">Зайти</a></li>
    <li><a href="{{ url('register') }}">Зарегаться</a></li>

@else
    <li>
        <a href="{{action('UserController@show', Auth::user()->name)}}">
            Профиль
        </a>
    </li>
    <li>
        <a href="{{ url('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выйти
        </a>

        <form id="logout-form" action="{{ url('logout') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
@endif