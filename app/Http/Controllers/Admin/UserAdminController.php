<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'nullable|alpha|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
        ]);

        $user->username = $request->input('username', $user->username);
        $user->name = $request->input('name', $user->name);
        $user->is_blocked = $request->has('is_blocked') ? true : false;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Данные пользователя успешно обновлены.');
    }

    public function updateUser(Request $request, $id)
    {
        // Здесь вы можете выполнить дополнительные проверки или изменения
        // Например, если нужно обновить только некоторые поля или внести какие-то другие изменения

        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'nullable|alpha|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
        ]);

        $user->username = $request->input('username', $user->username);
        $user->name = $request->input('name', $user->name);
        $user->is_blocked = $request->has('is_blocked') ? true : false;
        $user->save();

        return redirect()->route('user')->with('success', 'Данные пользователя успешно обновлены через updateUser.');
    }
}
