{{-- resources/views/admin/users/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать пользователя: {{ $user->username }}</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
            </div>
            <div class="form-group">
                <label for="is_blocked">Заблокирован</label>
                <input type="checkbox" id="is_blocked" name="is_blocked" {{ $user->is_blocked ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
