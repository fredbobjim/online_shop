@extends('auth.main')

@isset($sku)
    @section('title', 'Редактирование торгового предложения ')
@else
    @section('title', 'Создание торгового предложения')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($sku)
            <h1>Редактирование торгового предложения<br> <b>{{ $sku->product->name }} {{ $sku->propertyoptions->map->name->implode(', ') }}</b></h1>
        @else
            <h1>Создание торгового предложения для товара<br> <b>{{ $product->name }}</b></h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($sku)
                  action="{{ route('skus.update', [$product, $sku]) }}"
              @else
                  action="{{ route('skus.store',$product) }}"
            @endisset >
            <div>
                @isset($sku)
                    @method('PUT')
                @endisset
                @csrf
                <br>
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        @error('price')
                         <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="price" id="price"
                               value="@isset($sku){{ $sku->price }}@endisset">
                    </div>
                </div>
                    <br>
                <div class="input-group row">
                    <label for="count" class="col-sm-2 col-form-label">Количество на складе: </label>
                    <div class="col-sm-6">
                        @error('count')
                         <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="count" id="count"
                               value="@isset($sku){{ $sku->count }}@endisset">
                    </div>
                </div>
                <br>
                @foreach($product->properties as $property)
                    <br>

                    <div class="input-group row">
                        <label for="property_id" class="col-sm-2 col-form-label">{{ $property->name }}: </label>
                        <div class="col-sm-6">
                            <select name="property_id[{{$property->id}}]"  class="form-control">
                                @foreach($property->propertyOptions as $propertyOption)
                                    <option value="{{ $propertyOption->id }}"
                                            @isset($sku)
                                                @if($sku->propertyOptions->contains($propertyOption->id))
                                                    selected
                                        @endif
                                        @endisset
                                    >{{ $propertyOption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                @endforeach

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
