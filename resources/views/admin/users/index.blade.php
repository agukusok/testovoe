{{-- resources/views/admin/users/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список пользователей</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Заблокирован</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
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

        <div class="mt-3">
            <a href="{{ route('backpack.dashboard') }}" class="btn btn-secondary">Вернуться на панель управления</a>
        </div>
    </div>
@endsection
