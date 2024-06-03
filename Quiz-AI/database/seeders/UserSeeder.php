<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        Permission::firstOrCreate(['name' => 'edit articles']);
        Permission::firstOrCreate(['name' => 'publish articles']);
        Permission::firstOrCreate(['name' => 'super-admin']);

        $superAdmin = User::create([
            'name' => 'Super admin',
            'email' => 'admin@example.com',
            'password' => '1234567',
        ]);

        $superAdmin->assignRole($superAdminRole);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'test@gmail.com',
            'password' => '1234567',
        ]);

        $admin->assignRole($adminRole);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '1234567',
        ]);
        $user->assignRole($userRole);
    }
}
