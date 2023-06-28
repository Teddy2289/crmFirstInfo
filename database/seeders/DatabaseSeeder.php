<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);
        $addrole = Permission::create([
            'name' => 'add-role'
        ]);
        $editrole = Permission::create([
            'name' => 'edit-role'
        ]);
        $listrole = Permission::create([
            'name' => 'list-role'
        ]);
        $deleterole = Permission::create([
            'name' => 'delete-role'
        ]);
        $addpermission = Permission::create([
            'name' => 'add-permission'
        ]);
        $editpermission = Permission::create([
            'name' => 'edit-permission'
        ]);
        $listpermission = Permission::create([
            'name' => 'list-permission'
        ]);
        $deletepermission = Permission::create([
            'name' => 'delete-permission'
        ]);
        $edituser = Permission::create([
            'name' => 'edit-user'
        ]);
        $createuser = Permission::create([
            'name' => 'create-user'
        ]);
        $giveroleuser = Permission::create([
            'name' => 'giverole-user'
        ]);
        $givepermissionuser = Permission::create([
            'name' => 'givepermission-user'
        ]);
        $blokuser = Permission::create([
            'name' => 'blok-user'
        ]);
        $deleteuser = Permission::create([
            'name' => 'delete-user'
        ]);

        $admin->givePermissionTo(['add-role', 'edit-role', 'delete-role', 'add-permission', 'edit-permission', 'delete-permission','create-user']);
        $user = User::create([
            'name' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@gmail.com',
        ]);
        $user->assignRole('admin');
    }
}
