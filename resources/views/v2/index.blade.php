<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('v2/css/app.css') }}" rel="stylesheet">
    <title>Lemon</title>

    <!-- Fonts -->

    <!-- Styles -->
    <style>

    </style>
</head>
<body>
<div id="app"></div>
<script>window.v2 = {'apiUrl': '{{ e(route('v2.0')) }}', 'csrfToken': '{{e(csrf_token())}}' }</script>
<script src="{{ mix('v2/js/app.js') }}"></script>
</body>
</html>