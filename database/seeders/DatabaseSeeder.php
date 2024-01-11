<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::insert([
            [
                'name' => 'Cappuccino',
                'slug' => 'cappuccino'
            ],
            [
                'name' => 'Espresso',
                'slug' => 'espresso'
            ],
            [
                'name' => 'Americano',
                'slug' => 'americano'
            ],
            [
                'name' => 'Latte',
                'slug' => 'latte'
            ],
            [
                'name' => 'Black Coffee',
                'slug' => 'black-coffee'
            ],
        ]);
    }
}
