<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($header) ? trim(strip_tags($header)) . ' · ' : '' }}RuangToko</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/storefront.css') }}">
</head>
<body>
    @include('layouts.navigation')
    @isset($header)<header class="store-shell" style="padding-bottom:0"><div class="eyebrow">RuangToko / {{ request()->routeIs('manage.*') ? 'Manajemen' : (request()->routeIs('dashboard') ? 'Ruang akun' : 'Etalase') }}</div><div class="section-title mt-2">{{ $header }}</div></header>@endisset
    <main>{{ $slot }}</main>
    <footer class="page-footer">RuangToko <span style="padding:0 .35rem">·</span> Belanja lebih tenang, pilihan lebih bermakna.</footer>
</body>
</html>
