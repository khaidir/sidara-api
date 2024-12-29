<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'dashboard',
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'description' => 'Main dashboard page',
                'link' => '/dashboard',
            ],
            [
                'name' => 'users',
                'label' => 'Users',
                'icon' => 'fas fa-users',
                'description' => 'Manage system users',
                'link' => '/users',
            ],
            [
                'name' => 'settings',
                'label' => 'Settings',
                'icon' => 'fas fa-cogs',
                'description' => 'System settings',
                'link' => '/settings',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
