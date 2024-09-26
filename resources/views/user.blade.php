@extends('layouts.app')

@section('title', 'Профиль пользователя')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h1>Профиль пользователя</h1>
    <p>ID: {{ $user->id }}</p>
    <p>Имя: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Логин: {{ $user->username }}</p>



    <form action="{{route('update')}}" method="get" class="d-inline-block">
        <button type="submit" class="btn btn-success .text-white">Изменить данные</button>
    </form>
    <form action="{{ route('user.delete') }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger .text-white">Удалить аккаунт</button>
    </form>
    <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
        @csrf
        <button type="submit" class="btn btn-warning text-white">Выйти</button>
    </form>
</div>
@endsection