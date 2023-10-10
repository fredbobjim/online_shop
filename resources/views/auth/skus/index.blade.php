@extends('auth.main')

@section('title', 'Торговые предложения')

@section('content')
    <div class="col-md-12">
        <h1>Торговые предложения для товара<br> <b>{{ $product->name }}</b></h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Название
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $sku->id }}</td>
                    <td>{{ $sku->propertyoptions->map->name->implode(', ') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('skus.destroy', [$product, $sku]) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('skus.show', [$product, $sku]) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('skus.edit', [$product, $sku]) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-success" type="button"
           href="{{ route('skus.create', $product) }}">Добавить вариант</a>
    </div>
    {{ $skus->links() }}

@endsection
