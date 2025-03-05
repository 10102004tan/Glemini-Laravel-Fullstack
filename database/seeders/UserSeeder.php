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
        $editerRole = Role::firstOrCreate(['name' => 'editor']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        Permission::firstOrCreate(['name' => 'manage_users']);
        Permission::firstOrCreate(['name' => 'manage_content']);
        Permission::firstOrCreate(['name' => 'approve_content']);
        Permission::firstOrCreate(['name' => 'view_content']);
        

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
        $admin->givePermissionTo('manage_content');
        $admin->givePermissionTo('approve_content');
        $admin->givePermissionTo('manage_users');

        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editer@quizai.vn',
            'password' => '1234567',
        ]);
        $editor->assignRole($editerRole);
        $editor->givePermissionTo('manage_content');

        $moderator = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@quizai.vn',
            'password' => '1234567',
        ]);
        $moderator->assignRole($moderatorRole);
        $moderator->givePermissionTo('view_content');
        $admin->givePermissionTo('approve_content');


        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '1234567',
        ]);
        $user->assignRole($userRole);
    }
}
