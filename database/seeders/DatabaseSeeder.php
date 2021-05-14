<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create(['role_name' => 'Super Admin']);
        Role::create(['role_name' => 'Admin']);
        Role::create(['role_name' => 'Inventory Manager']);
        Role::create(['role_name' => 'Order Manager']);
        Role::create(['role_name' => 'Customer']);
        // Category::create(['cname' => 'Laptop']);
        // Category::create(['cname' => 'Car']);
        // Category::create(['cname' => 'Mobile']);
        // Category::create(['cname' => 'Cloths']);
        // Category::create(['cname' => 'Shoes']);
    }
}