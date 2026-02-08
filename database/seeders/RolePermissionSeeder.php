<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissiongroups = [
            'User',
            'Role',
            'Permission Group',
            'Permission',
            'Menu',
            'Article Category',
            'Article',
            'Setting',
            'Board',
        ];

        foreach ($permissiongroups as $permissiongroup) {
            PermissionGroup::create([
                'name' => $permissiongroup
            ]);
        }

        $permissions = [
            'User Access-1',
            'User Detail-1',
            'User Create-1',
            'User Update-1',
            'User Banned-1',
            'User Role Create-1',
            'Role Access-2',
            'Role Detail-2',
            'Role Create-2',
            'Role Update-2',
            'Role Delete-2',
            'Permission Group Access-3',
            'Permission Group Create-3',
            'Permission Group Update-3',
            'Permission Group Delete-3',
            'Permission Access-4',
            'Permission Create-4',
            'Permission Update-4',
            'Permission Delete-4',
            'Menu Access-5',
            'Menu Create-5',
            'Menu Update-5',
            'Menu Delete-5',
            'Article Category Access-6',
            'Article Category Create-6',
            'Article Category Update-6',
            'Article Category Delete-6',
            'Article Access-7',
            'Article Detail-7',
            'Article Create-7',
            'Article Update-7',
            'Article Delete-7',
            'Setting Access-8',
            'Setting Detail-8',
            'Setting Create-8',
            'Setting Update-8',
            'Setting Delete-8',
            'Board Access-9',
            'Board Create-9',
            'Board Update-9',
            'Board Delete-9',
        ];

        foreach ($permissions as $permission) {
            $permission_array = explode("-", $permission);
            Permission::create([
                'name' => $permission_array[0],
                'permission_group_id' => $permission_array[1]
            ]);
        }

        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $role = Role::create([
            'name' => 'User',
            'guard_name' => 'web'
        ]);
        $role->givePermissionTo('Article Access');
    }
}
