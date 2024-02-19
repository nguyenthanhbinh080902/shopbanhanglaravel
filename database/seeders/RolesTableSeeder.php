<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // xóa csdl sẵn có 
        Roles::truncate();

        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'author']);
        Roles::create(['name' => 'user']);

    }
}
