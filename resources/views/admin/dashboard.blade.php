{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Панель управления администратора</h1>

        <h2>Список пользователей</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Имя пользователя</th>
                    <th>Заблокирован</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" name="is_blocked" value="1" {{ $user->is_blocked ? 'checked' : '' }} onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Редактировать</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Выйти</button>
        </form>
    </div>
@endsection
