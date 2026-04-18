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
            ['name' => 'Grocery', 'icon' => '🍞', 'color' => '#CCFF80'],
            ['name' => 'Work', 'icon' => '💼', 'color' => '#FF9680'],
            ['name' => 'Sport', 'icon' => '⚽', 'color' => '#80FFFF'],
            ['name' => 'Design', 'icon' => '🎨', 'color' => '#80FFA3'],
            ['name' => 'University', 'icon' => '🎓', 'color' => '#809CFF'],
            ['name' => 'Social', 'icon' => '👥', 'color' => '#FF80EB'],
            ['name' => 'Music', 'icon' => '🎵', 'color' => '#FC80FF'],
            ['name' => 'Health', 'icon' => '❤️', 'color' => '#80FFA3'],
            ['name' => 'Movie', 'icon' => '🎬', 'color' => '#80FFFF'],
            ['name' => 'Home', 'icon' => '🏠', 'color' => '#FFCC80'],
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
