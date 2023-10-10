@extends('auth.main')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Телефон
                </th>
                <th>
                    Email
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Сумма
                </th>
                <th>
                    Действия
                </th>
            </tr>

            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->sum}} ₽</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                               @if (auth()->user()->isAdmin())
                                   href="{{ route('order', $order)}}"
                               @else
                                   href="{{ route('person.orders.show', $order)}}"
                               @endif
                            >Состав заказа</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    {{ $orders->links('vendor.pagination.pagination') }}
@endsection
