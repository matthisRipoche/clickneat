<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Restaurant::factory(3)->create();
        Category::factory(12)->create();
        Item::factory(50)->create();

        User::factory(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]
        )->create();
    }
}
