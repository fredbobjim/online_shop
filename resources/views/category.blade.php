@extends('main')
@section('title', 'Категория - '.$category->translate('name'))
@section('content')
    <div class="starter-template">
        <h1>
            {{ $category->translate('name')}}
        </h1>
        <p>
            {{ $category->translate('description')}}
        </p>
        <div class="row">
            @foreach ($skus as $sku)
                @include('card', compact('sku'))
            @endforeach
        </div>
    </div>
    {{ $skus->links('vendor.pagination.pagination')}}
@endsection
