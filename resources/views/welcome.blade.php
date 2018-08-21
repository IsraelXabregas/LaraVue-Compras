<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content=">{{ csrf_token() }}">
    <title>Lista de Compras com Laravel e Vue.js</title>
</head>
<body>
<div id="app" class="container">
    <tasks></tasks>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>
</html>
