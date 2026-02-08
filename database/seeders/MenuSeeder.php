<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'nama_menu' => 'Setting Admin',
            'icon' => 'settings',
            'status' => '1',
            'sort' => '1',
        ]);
        Menu::create([
            'menu_id' => '1',
            'nama_menu' => 'User Management',
            'status' => '1',
            'sort' => '2',
        ]);
        Menu::create([
            'menu_id' => '2',
            'nama_menu' => 'Users',
            'permission_group_id' => 1,
            'href' => '/user',
            'status' => '1',
            'sort' => '1',
        ]);
        Menu::create([
            'menu_id' => '2',
            'nama_menu' => 'Roles',
            'permission_group_id' => 2,
            'href' => '/role',
            'status' => '1',
            'sort' => '2',
        ]);
        Menu::create([
            'menu_id' => '2',
            'nama_menu' => 'Permission Group',
            'permission_group_id' => 3,
            'href' => '/permissiongroup',
            'status' => '1',
            'sort' => '3',
        ]);
        Menu::create([
            'menu_id' => '2',
            'nama_menu' => 'Permissions',
            'permission_group_id' => 4,
            'href' => '/permission',
            'status' => '1',
            'sort' => '4',
        ]);
        Menu::create([
            'menu_id' => '1',
            'nama_menu' => 'Menu Setting',
            'permission_group_id' => 5,
            'href' => '/menu',
            'status' => '1',
            'sort' => '3',
        ]);

        Menu::create([
            'nama_menu' => 'Article',
            'icon' => 'clipboard',
            'status' => '1',
            'sort' => '2',
        ]);

        Menu::create([
            'menu_id' => '8',
            'nama_menu' => 'Article Categories',
            'permission_group_id' => 6,
            'href' => '/article_categories',
            'status' => '1',
            'sort' => '1',
        ]);

        Menu::create([
            'menu_id' => '8',
            'nama_menu' => 'Article',
            'permission_group_id' => 7,
            'href' => '/article',
            'status' => '1',
            'sort' => '2',
        ]);

        Menu::create([
            'menu_id' => '1',
            'nama_menu' => 'Website Setting',
            'permission_group_id' => 8,
            'href' => '/setting',
            'status' => '1',
            'sort' => '1',
        ]);

        Menu::create([
            'nama_menu' => 'Board',
            'icon' => 'book-open',
            'href' => '/boards',
            'permission_group_id' => 9,
            'status' => '1',
            'sort' => '3',
        ]);
    }
}
