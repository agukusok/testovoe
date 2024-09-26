<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\User;

class AdminDashboardController extends CrudController
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }
}