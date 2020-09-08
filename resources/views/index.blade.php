<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="description" content="{{ $description }}">
    <title>{{ config('app.name') }}</title>
    <link href=" {{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
