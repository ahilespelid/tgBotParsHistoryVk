<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description')">
    
        <title>@yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="/assets/css/app.css?<?=time();?>"/>
        <!-- Script -->
        <script src="/assets/js/app.js?<?=time();?>"></script>
</head>
<body>
<header id="head"></header>
<section><div></div>
  <div class="bar">
    <div class="bar__body">
        <span class="bar__body_title">Инстанции</span>
        <div class="bar__body__list">
            <a href="{{ route('front.home', ['deal_id' => $deal]) }}"><div class="bar__body__list_i i_width50"><=</div></a>
            <a href="{{ route('front.bot', ['time' => time(), 'deal_id' => $deal]) }}"><div class="bar__body__list_i @if('public' == '') __list_i_check @endif">Истории ВК</div></a>
@if(4 == $deal)
@elseif(6 == $deal)
@endif
        </div>
    </div>
  </div><div></div><div></div>
  <div class="content">
        @yield('content')
        <footer>@yield('footer')</footer>
  </div><div></div>
</section>
</body>