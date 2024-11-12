<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultCategories = [
            'Food',
            'Transportation',
            'Entertainment',
            'Utilities',
            'Health',
            'Education',
            'Miscellaneous',
        ];

        foreach ($defaultCategories as $categoryName) {
            Category::firstOrCreate([
                'name' => $categoryName,
                'is_default' => true,
                'user_id' => null
            ]);
        }
    }
}
