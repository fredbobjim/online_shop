@extends('auth.main')

@section('title', 'Заказ №' . $order->id)

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Заказ №{{ $order->id }}</h1>
                    <p>Заказчик: <b>{{ $order->name }}</b></p>
                    <p>Номер телефона: <b>{{ $order->phone }}</b></p>
                    <p>Email: <b>{{ $order->email }}</b></p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($skus as $sku)
                            <tr>
                                <td>
                                    <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                                        <img width="50px" height="50px"
                                             src="{{ Storage::url($sku->product->image) }}">
                                        {{ $sku->product->name }}
                                    </a>
                                </td>
                                <td><span class="badge"> {{ $sku->pivot->count}}</span></td>
                                <td>{{ $sku->pivot->price }} ₽</td>
                                <td>{{ $sku->pivot->count * $sku->pivot ->price}} ₽</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Общая стоимость:</td>
                            <td>{{ $order->sum }} ₽</td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection
