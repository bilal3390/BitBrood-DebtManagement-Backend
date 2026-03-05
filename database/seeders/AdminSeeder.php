<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@bitbrood.com'],
            [
                'name' => 'Admin',
                'password' => 'Hexa2056',
                'role' => Admin::ROLE_SUPER_ADMIN,
            ]
        );
    }
}
