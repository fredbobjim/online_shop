@extends('main')
@section('title', 'Корзина')
@section('content')
    <div class="starter-template">
        <h1>@lang('basket.header')</h1>
        <p>@lang('basket.order')</p>
        <div class="panel">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang('basket.name')</th>
                    <th>@lang('basket.quantity')</th>
                    <th>@lang('basket.price')</th>
                    <th>@lang('basket.cost')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach ($order->skus as $sku )
                    @if($sku->countInOrder > 0)
                        <tr>
                            <td>
                                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                                    <img height="56px" src="{{Storage::url($sku->product->image)}}">
                                    {{$sku->product->translate('name')}}
                                </a>
                            </td>
                            <td><span class="badge">{{ $sku->countInOrder}}</span>
                                <div class="btn-group form-inline">
                                    <form action="{{route('basket-remove', $sku)}}" method="POST">
                                        <button type="submit" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                        </button>
                                        @csrf
                                    </form>
                                    <form action="{{route('basket-add', $sku)}}" method="POST">
                                        <button type="submit" class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                        @csrf
                                    </form>

                                </div>
                            </td>
                            <td>{{ $sku->price}} ₽</td>
                            <td>{{ $sku->price * ($sku->countInOrder)}} ₽</td>
                            <td>
                                <form action="{{route('basket-remove', $sku)}}" method="POST">
                                    <input type="hidden" name="delete" value="Y">
                                    <button type="submit" class="remove-basket-item" title="Удалить товар">X</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="3">@lang('basket.full_cost'):</td>
                    <td>{{ $order->getFullSum() }} ₽</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('basket-order') }}">@lang('basket.make_order')</a>
            </div>
        </div>
    </div>
@endsection
