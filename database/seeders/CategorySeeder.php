<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // First, ensure we have a test user to attach default categories to
        $user = User::firstOrCreate([
            'email' => 'test@example.com'
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $defaultCategories = [
            ['name' => 'Grocery', 'icon' => 'shopping-cart', 'color' => '#CCFF80'],
            ['name' => 'Work', 'icon' => 'briefcase', 'color' => '#FF9680'],
            ['name' => 'Sport', 'icon' => 'activity', 'color' => '#80FFFF'],
            ['name' => 'Design', 'icon' => 'pen-tool', 'color' => '#80FFA3'],
            ['name' => 'Study', 'icon' => 'graduation-cap', 'color' => '#809CFF'],
            ['name' => 'Social', 'icon' => 'users', 'color' => '#FF80EB'],
            ['name' => 'Music', 'icon' => 'music', 'color' => '#FC80FF'],
            ['name' => 'Health', 'icon' => 'heart', 'color' => '#80FFA3'],
            ['name' => 'Movie', 'icon' => 'film', 'color' => '#80FFFF'],
            ['name' => 'Home', 'icon' => 'home', 'color' => '#FFCC80'],
        ];

        foreach ($defaultCategories as $category) {
            Category::firstOrCreate([
                'user_id' => $user->id,
                'name' => $category['name'],
            ], [
                'icon' => $category['icon'],
                'color' => $category['color'],
            ]);
        }
    }
}
