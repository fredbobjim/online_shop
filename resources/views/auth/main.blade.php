<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка: @yield('title')</title>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/app.js" defer></script>
    <script src="/js/script.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">Вернуться на сайт</a>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li ><a href="{{route('categories.index')}}">Категории</a></li>
                            <li ><a href="{{route('products.index')}}">Товары</a></li>
                            <li ><a href="{{route('properties.index')}}">Свойства</a></li>
                            <li ><a href="{{route('orders')}}">Заказы</a></li>
                        @endif
                    @endauth
                </ul>
                @guest
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                        </li>
                    </ul>
                @endguest
                @auth
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            @if (auth()->user()->isAdmin())
                                <a class="nav-link" href="{{ route('orders')}}">Администратор</a>
                            @else
                                <a class="nav-link" href="{{ route('person.orders.index')}}">Мои заказы</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('logout')}}">Выйти</a>
                            <form id="logout-form" action="{{ route('logout')}}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    <div class="starter-template">
        @if (session()->has('success'))
            <p class="alert alert-success">{{session()->get('success')}}</p>
        @endif
        @if (session()->has('warning'))
            <p class="alert alert-warning">{{session()->get('warning')}}</p>
        @endif
    </div>
</div>
<div class="py-4">
    <div class="container">
        @yield('content')
    </div>
</div>
</div>
</body>
</html>
