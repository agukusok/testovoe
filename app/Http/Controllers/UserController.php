<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'required|string|unique:users,username|max:255|regex:/^[a-zA-Z]+$/',
            'email' => 'required|string|email|unique:users,email|max:255',
        ], [
            'username.required' => 'Пожалуйста, введите имя пользователя.',
            'username.unique' => 'Это имя пользователя уже занято.',
            'username.regex' => 'Имя пользователя должно содержать только латинские буквы.',
            'email.required' => 'Пожалуйста, введите адрес электронной почты.',
            'email.unique' => 'Этот адрес электронной почты уже используется.',
            'email.email' => 'Пожалуйста, введите действительный адрес электронной почты.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        Auth::login($user);

        if (Auth::check()) {
            return redirect()->route('login')->with('success', 'Регистрация прошла успешно!');
        }

        return redirect()->back()->withErrors(['error' => 'Ошибка при регистрации. Пожалуйста, попробуйте еще раз.']);
    }





    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
        ]);

        $credentials = $request->only('username', 'email');

        $user = User::where('username', $credentials['username'])
            ->where('email', $credentials['email'])
            ->first();

        if ($user) {
            // Проверка на блокировку
            if ($user->is_blocked) {
                return redirect()->back()->withErrors(['error' => 'Пользователь заблокирован.']);
            }

            Auth::login($user);
            return redirect()->route($user->hasRole('admin') ? 'backpack.dashboard' : 'user')
                ->with('success', 'Вы успешно вошли в систему.');
        }

        return redirect()->back()->withErrors(['error' => 'Неверные учетные данные']);
    }







    public function getUserInfo(Request $request)
    {
        $userId = $request->header('User-Id');
        $user = User::findOrFail($userId);

        if ($user->is_blocked) {
            return response()->json(['error' => 'User is blocked'], 403);
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        // Валидация входящих данных
        $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
        ]);

        // Поиск пользователя по ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user')->withErrors(['message' => 'Пользователь не найден']);
        }

        // Обновление полей пользователя
        $user->name = $request->input('name', $user->name);
        $user->username = $request->input('username', $user->username);
        $user->save();

        // Перенаправление на страницу профиля пользователя с сообщением об успехе
        return redirect()->route('user')->with('success', 'Данные обновлены успешно');
    }








    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Вы успешно вышли из системы.');
    }


    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему, чтобы удалить свой аккаунт.');
        }

        User::findOrFail($user->id)->delete();

        Auth::logout();

        return redirect()->route('register')->with('success', 'Ваш аккаунт был успешно удалён.');
    }




    public function showProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему, чтобы просмотреть свой профиль.');
        }

        return view('user', compact('user'));
    }

    public function showUpdateForm()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему, чтобы изменить данные.');
        }

        return view('update', compact('user'));
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }
}
