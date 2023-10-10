@extends('auth.main')

@section('title', 'Торговые предложения ')

@section('content')
    <div class="col-md-12">
        <h1>Торговое предложение<br> <b>{{ $sku->product->name }} {{ $sku->propertyoptions->map->name->implode(', ') }}</b></h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $sku->id }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $sku->price }}</td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{{ $sku->count }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
