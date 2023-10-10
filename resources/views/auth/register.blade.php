@extends('auth.main')
@section('title', 'Регистрация')
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Регистрация</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" aria-label="Register">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>
                        <div class="col-md-6">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input id="name" type="text" class="form-control" name="name"
                                   value="{{ old('name') }}" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                        <div class="col-md-6">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input id="email" type="text" class="form-control"
                                   value="{{ old('email') }}" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                        <div class="col-md-6">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input id="password" type="password" class="form-control"
                                   name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердите пароль</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
