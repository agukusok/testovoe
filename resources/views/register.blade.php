@extends('layouts.app')
@section('title')
Регистрация
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-md-4">
        <h3 class="head-text">Регистрация</h3>
        <form action="{{route('api.register')}}" method="post" class="reg-form text">
            @csrf
            <div class="form-group">
                <label for="name">Введите имя</label>
                <input type="text" name="name" placeholder="Введите имя" id="name" class="form-control form-my">
            </div>
            <div class="form-group">
                <label for="email">Введите email</label>
                <input type="text" name="email" placeholder="Введите email" id="email" class="form-control form-my">
            </div>
            <div class="form-group">
                <label for="username">Введите логин</label>
                <input type="text" name="username" placeholder="Введите логин" id="username" class="form-control form-my">
            </div>

            <button type="submit" class="btn btn-my">Зарегестрироваться</button>
        </form>
        <a href="{{route('login')}}" id="reg-link">Есть аккаунт? Войдите в систему</a>

    </div>
</div>

@endsection