@if (Session::has('status'))
    <div style="position: fixed;
            top: 10px;
            left: 10px;
            visibility: hidden;
            z-index: 100;">
        <p>{{ Session::get('status') }}</p>
    </div>
@endif