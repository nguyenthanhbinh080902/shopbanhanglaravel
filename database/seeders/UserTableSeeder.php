<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'binhadmin',
            'admin_email' => 'binhadmin@yahoo.com',
            'admin_phone' => '12345',
            'admin_password' => md5('123456')
        ]);

        $author = Admin::create([
            'admin_name' => 'binhauthor',
            'admin_email' => 'binhauthor@yahoo.com',
            'admin_phone' => '111222333',
            'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
            'admin_name' => 'binhuser',
            'admin_email' => 'binhuser@yahoo.com',
            'admin_phone' => '444555666',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

    }
}
