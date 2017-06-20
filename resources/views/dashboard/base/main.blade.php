<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .user{
            margin: 0;
            padding: 0;
        }
        .user li{
            display: block;
            text-align: center;
        }
        .user li img{
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }
        .nav li {
            font-size: 14px;
        }
        .nav li a span{
            margin-left: 10px;
            margin-right: 20px;
        }
    </style>
</head>

<body>


<div id="app"></div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
