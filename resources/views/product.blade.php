@extends('main')
@section('title', $sku->product->translate('name'))
@section('content')
    <div class="starter-template">
        <h1>{{$sku->product->translate('name')}}</h1>
        <h2>{{$sku->product->category->translate('name')}}</h2>
        <p>@lang('product.price'): <b>{{$sku->price}} ₽</b></p>
        @isset($sku->product->properties)
            @foreach($sku->propertyOptions as $propertyOption)
                <h5> {{$propertyOption->property->translate('name')}} : <b>{{ $propertyOption->translate('name') }}</b></h5>
            @endforeach
        @endisset
        <img src="{{ Storage::url($sku->product->image)}}" height="300" alt="{{$sku->product->translate('name')}} image">
        <p>{{$sku->product->translate('description')}}</p>
        <p>@lang('product.quantity'): <b>{{$sku->count >= 1 ? $sku->count : 0}} шт.</b></p>

        <form action="{{ route('basket-add', $sku) }}" method="POST">
            <button type="submit"
                    class="btn btn-success">@lang('product.add_to_cart')</button>
            @csrf
        </form>
    </div>
@endsection
