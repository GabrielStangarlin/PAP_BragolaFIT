<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategoryToCreate = [
            [
                'name' => 'Whey Protein',
                'category_id' => 1,
            ],
            [
                'name' => 'Albumina',
                'category_id' => 1,
            ],
            [
                'name' => 'Whey Protein Isolado',
                'category_id' => 1,
            ],
            [
                'name' => 'Barra de Proteína e Afins',
                'category_id' => 1,
            ],
            [
                'name' => 'Hipercalórico',
                'category_id' => 2,
            ],
            [
                'name' => 'Maltodextrina',
                'category_id' => 2,
            ],
            [
                'name' => 'Mass Gainer',
                'category_id' => 2,
            ],
            [
                'name' => 'Proteínas',
                'category_id' => 3,
            ],
            [
                'name' => 'Aminoácidos',
                'category_id' => 3,
            ],
            [
                'name' => 'Carboidratos',
                'category_id' => 3,
            ],
            [
                'name' => 'Vitaminas',
                'category_id' => 3,
            ],
            [
                'name' => 'Complexo B',
                'category_id' => 4,
            ],
            [
                'name' => 'MultiVitaminico',
                'category_id' => 4,
            ],
            [
                'name' => 'Carnitina',
                'category_id' => 4,
            ],
            [
                'name' => 'Pré-treino',
                'category_id' => 5,
            ],
            [
                'name' => 'Pós-treino',
                'category_id' => 5,
            ],
            [
                'name' => 'Omega 3',
                'category_id' => 5,
            ],
            [
                'name' => 'Shaker',
                'category_id' => 5,
            ],
            [
                'name' => 'Cafeína',
                'category_id' => 5,
            ],
        ];

        foreach ($subCategoryToCreate as $subcategory) {
            Subcategory::updateOrCreate(
                [
                    'name' => $subcategory['name'],
                    'category_id' => $subcategory['category_id'],
                ],
                $subcategory
            );
        }
    }
}
