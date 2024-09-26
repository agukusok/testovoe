<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\User;

class UserCrudController extends CrudController
{
    public function setup()
    {
        CRUD::setModel(User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('пользователя', 'пользователи');

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Имя',
        ]);

        CRUD::addField([
            'name' => 'username',
            'type' => 'text',
            'label' => 'Имя пользователя',
        ]);

        CRUD::addField([
            'name' => 'is_blocked',
            'type' => 'checkbox',
            'label' => 'Заблокирован',
        ]);
    }

    public function index()
    {
        return view('backpack::crud.index');
    }
}
