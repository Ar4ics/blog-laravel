<ul class="menu">

    <li class="menu-text">
        Простой блог
    </li>

    <li>
        <a href="{{ action('PostController@index') }}">
            Посты
            <span class="badge secondary">{{ $count_posts }}</span>
        </a>

    </li>
    <li>
        <a href="{{ action('TagController@index') }}">
            Теги
            <span class="badge secondary">{{ $count_tags }}</span>
        </a>

    </li>
    <li><a href="{{ action('PostController@show', $last_comment->article->slug) }}">
            Комменты
            <span class="badge secondary">{{ $count_comments }}</span>
        </a>
    </li>
</ul>