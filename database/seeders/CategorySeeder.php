<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryToCreate = [
            ['name' => 'Proteína'],
            ['name' => 'Carboidratos'],
            ['name' => 'Vegetarianos'],
            ['name' => 'Vitaminas'],
            ['name' => 'Outros'],
        ];

        foreach ($categoryToCreate as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
