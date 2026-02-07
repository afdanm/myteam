<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);

        $admin = User::create([
            'username' => 'dan',
            'name' => 'afdan maulana',
            'email' => 'afdanmaulana1777@gmail.com',
            'email_verified_at' => '2022-08-16 20:57:19',
            'password' => Hash::make('#!dan#')
        ]);

        $admin->assignRole('Super Admin');

        $user = User::create([
            'username' => 'user',
            'name' => 'User Website',
            'email' => 'user@gmail.com',
            'email_verified_at' => '2022-08-16 20:57:19',
            'password' => Hash::make('#user!#')
        ]);

        $user->assignRole('User');

        Setting::create([
            'key' => 'title',
            'value' => 'ESTO CMS',
            'serialize' => 0,
        ]);

        Setting::create([
            'key' => 'keyword',
            'value' => 'a:6:{i:0;s:7:"Laravel";i:1;s:9:"Framework";i:2;s:17:"Framework Laravel";i:3;s:3:"CMS";i:4;s:8:"ESTO CMS";i:5;s:24:"PT Esto Kreasi Nusantara";}',
            'serialize' => 1,
        ]);

        Setting::create([
            'key' => 'description',
            'value' => 'CMS (Content Management System) untuk Laravel karya anak bangsa PT Esto Kreasi Nusantara Head Bisnis Unit IT Conculting Tintapuccino, CMS ini berguna untuk membuat struktur awal sebuah website dimana CMS ini memiliki fitur dasar untuk Artikel, dan sudah memiliki hierarki user',
            'serialize' => 0,
        ]);

        Setting::create([
            'key'   => 'favicon',
            'value' => asset('/assets/images/favicon.png'),
            'serialize' => 0,
        ]);

        Setting::create([
            'key'   => 'author',
            'value' => 'PT Esto Kreasi Nusantara Indonesia',
            'serialize' => 0,
        ]);

        $this->call(MenuSeeder::class);
    }
}
