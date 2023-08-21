<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création des rôles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Création des permissions
        $permissions = [
            'add-role', 'edit-role',
            'delete-role', 'add-permission',
            'edit-permission', 'delete-permission',
            'edit-user', 'create-user',
            'giverole-user', 'givepermission-user',
            'block-user', 'delete-user',
            'add-client', 'edit-client',
            'delete-client', 'add-company',
            'edit-company', 'delete-company',
            'edit-contract', 'delete-contract',
            'add-contract', 'add-employe',
            'edit-employe', 'delete-employe',
            'add-technology', 'edit-technology',
            'delete-technology','add-leave-type','edit-leave-type',
            'delete-leave-type','add-post-employee',
            'edit-post-employee','delete-post-employee',
            'view_technology','view_company','view_clients',
            'manage_permissions','manage_roles','view_contract',
            'view_invoice_list','view_billing','view_employee_list',
            'view_post_employer','view_type_leave','manage_users',
            'manage_countries'
                ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Attribution des permissions au rôle admin
        $adminRole->givePermissionTo($permissions);

        // Création de l'utilisateur admin
        $user = User::create([
            'name' => 'FirstInfoLab',
            'password' => bcrypt('password'),
            'email' => 'admin@gmail.com',
        ]);

        // Attribution du rôle admin à l'utilisateur admin
        $user->assignRole('admin');
    }
}
