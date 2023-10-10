@extends('main')
@section('title', 'Заказать')
@section('content')
    <div class="starter-template">
        <h1>@lang('order.header'):</h1>
        <div class="container">
            <div class="row justify-content-center">
                <p>@lang('order.total'): <b>{{$order->getFullSum()}} ₽</b></p>
                <form action="{{ route('basket-confirm')}}" method="POST">
                    <div>
                        <p>@lang('order.note'):</p>
                        <div class="container">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">@lang('order.name'): </label>
                                <div class="col-lg-4">
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="phone" class="control-label col-lg-offset-3 col-lg-2">@lang('order.phone'): </label>
                                <div class="col-lg-4">
                                    <input type="text" name="phone" id="phone" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            @guest
                                <div class="form-group">
                                    <label for="name" class="control-label col-lg-offset-3 col-lg-2">@lang('order.email'): </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="email" id="email" value="" class="form-control">
                                    </div>
                                </div>
                            @endguest
                        </div>
                        <br>
                        @csrf
                        <input type="submit" class="btn btn-success" value="@lang('order.header')">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
