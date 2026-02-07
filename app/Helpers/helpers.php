<?php

use App\Models\Menu;
use App\Models\Setting;

if(!function_exists('menu'))
{
    function menu($menu = NULL)
    {
        $menu_array = array();
        if (is_null($menu)) {
            $menus = Menu::whereNull('menu_id')->where('status',true)->orderBy('sort')->get();
        } else {
            $menus = Menu::where([['menu_id', $menu->id],['status',true]])->orderBy('sort')->get();
        }

        foreach ($menus as $menu) {
            $data = array();
            if (!is_null($menu->permission_group_id)) {
                $permissions = $menu->permissiongroup->permissions;
                $data_permission = array();
                foreach ($permissions as $permission) {
                    $data_permission[] = $permission->name;
                }

                if (Auth::user()->canany($data_permission)) {
                    $data['id'] = $menu->id;
                    $data['menu_id'] = $menu->menu_id;
                    $data['nama_menu'] = $menu->nama_menu;
                    $data['icon'] = $menu->icon;
                    $data['permission_group_id'] = $menu->permission_group_id;
                    $data['href'] = $menu->href;
                }
            } else {
                $data_child = array();
                if (isset($menu->child)) {
                    $data_array = menu($menu);
                    if (!is_null($data_array)) {
                        $data_child = menu($menu);
                    }
                }
                if (!empty($data_child)) {
                    $data['id'] = $menu->id;
                    $data['menu_id'] = $menu->menu_id;
                    $data['nama_menu'] = $menu->nama_menu;
                    $data['icon'] = $menu->icon;
                    $data['permission_group_id'] = $menu->permission_group_id;
                    $data['href'] = $menu->href;
                    $data['child'] = $data_child;
                }
            }

            if (!empty($data)) {
                $menu_array[] = $data;
                $data = array();
            }
        }

        if (!empty($menu_array)) {
            return $menu_array;
        } else {
            return NULL;
        }
    }
}

if(!function_exists('settings')){
    function settings()
    {
        $data['title'] = Setting::getValue('title');
        $keyword = Setting::getValue('keyword');
        if(is_Array($keyword)){
            $keyword = implode(',',$keyword);
        }
        $data['keyword'] = $keyword;
        $data['description'] = Setting::getValue('description');
        $data['author'] = Setting::getValue('author');
        $data['favicon'] = Setting::getValue('favicon');

        return $data;
    }
}
