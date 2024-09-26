@extends('layouts.app')

@section('title')
Авторизация
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-4">
        <h3 class="head-text">Авторизация</h3>
        <form action="{{ route('login.submit') }}" method="post" class="reg-form text">
            @csrf
            <div class="form-group">
                <label for="email">Введите email</label>
                <input type="email" name="email" placeholder="Введите email" id="email" class="form-control form-my" required>
            </div>
            <div class="form-group">
                <label for="username">Введите логин</label>
                <input type="text" name="username" placeholder="Введите логин" id="username" class="form-control form-my" required>
            </div>
            <button type="submit" class="btn btn-my">Войти</button>
        </form>
        <a href="{{route('register')}}" id="reg-link">Нет аккаунт? Зарегестрируйтесь</a>
    </div>
</div>
@endsection