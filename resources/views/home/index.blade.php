<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('home/css/app.css') }}" rel="stylesheet">
    <title>Lemon</title>
</head>
<body>
<div id="app"></div>
<script>window.Home = {'apiUrl': '{{ e(route('home')) }}', 'csrfToken': '{{e(csrf_token())}}' }</script>
<script src="{{ mix('home/js/app.js') }}"></script>
</body>
</html>