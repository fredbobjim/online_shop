<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('main.online_shop'): @yield('title') </title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/template.css" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('index')}}">{{__('main.online_shop')}}</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li @routeactive('categories')><a href="{{route('categories')}}">@lang('main.categories')</a></li>
                        <li @routeactive('basket')><a href="{{route('basket')}}">@lang('main.to_basket')</a></li>
                        <li><a href="{{route('locale', __('main.set_lang'))}}">{{ __('main.set_lang') }}</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{route('login')}}">@lang('main.login')</a></li>
                        @endguest
                        @auth
                            @if (auth()->user()->isAdmin())
                                <li class='nav-item'><a href="{{route('orders')}}">@lang('main.admin_panel')</a></li>
                            @else
                                <li class='nav-item'><a href="{{route('person.orders.index')}}">@lang('main.my_orders')</a></li>
                            @endif
                                <li class='nav-item'><a href="{{route('logout')}}">@lang('main.logout')</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="starter-template">
                @if (session()->has('success'))
                    <p class="alert alert-success">{{session()->get('success')}}</p>
                @endif
                @if (session()->has('warning'))
                    <p class="alert alert-warning">{{session()->get('warning')}}</p>
                @endif
                @yield('content')
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <p>©2023 Интернет-магазин</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
