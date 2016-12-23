<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <base href="/" />
    <!-- Required meta tags always come first -->
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Сайт</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.min.css">

    <link rel="stylesheet" href="{{url('css/app.css')}}">

</head>
<body>

<div id="container"></div>

<!-- Scripts -->
@include ('footer')
<script src="/js/app.js"></script>

</body>
</html>
