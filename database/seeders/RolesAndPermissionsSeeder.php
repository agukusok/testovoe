<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Импорт класса Role
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Создание ролей
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Назначение роли пользователю
        $user = User::find(1); // Найдите пользователя, которому хотите назначить роль
        $user->assignRole('admin'); // Назначьте роль админа
    }
}
