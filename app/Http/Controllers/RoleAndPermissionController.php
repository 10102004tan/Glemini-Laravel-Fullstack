<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'user');
        })->with(['roles', 'permissions'])->get();
        return view('admin.roles.index', compact('roles', 'permissions', 'users'));
    }
}
