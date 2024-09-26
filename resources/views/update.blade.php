@extends('layouts.app')

@section('title')
Изменение данных
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-md-4">
        <h3 class="head-text">Изменение данных</h3>
        <form action="{{ route('admin.users.updateUser', $user->id) }}" method="POST" class="reg-form text">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Введите имя</label>
                <input type="text" name="name" placeholder="Введите имя" id="name" class="form-control form-my" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="username">Введите логин</label>
                <input type="text" name="username" placeholder="Введите логин" id="username" class="form-control form-my" value="{{ old('username', $user->username) }}" required>
            </div>

            <button type="submit" class="btn btn-my">Обновить данные</button>
        </form>
    </div>
</div>

@endsection
