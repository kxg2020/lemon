<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <title>Laravel</title>

    <!-- Fonts -->

    <!-- Styles -->
    <style>

    </style>
</head>
<body>
<div id="app"></div>
<script>window.Dashboard = {'apiUrl': '{{ e(route('api')) }}' }</script>
<script src="{{ asset('backend/js/app.js') }}"></script>
</body>
</html>