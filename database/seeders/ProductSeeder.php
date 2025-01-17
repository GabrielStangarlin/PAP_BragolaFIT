<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsToCreate = [
            [
                'name' => 'Whey Protein Chocolate',
                'description' => 'Whey Protein Concentrado de chocolate (30g)',
                'price' => '2.99',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_dose-whey-protein-concentrado-30gr-growth-supplements-6.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [1, 16],
            ],
            [
                'name' => 'Whey Protein Sem Sabor',
                'description' => 'Whey Protein Concentrado sem sabor (1Kg)',
                'price' => '18.99',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_top-whey-protein-concentrado-1kg-growth-supplements-19.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [1, 16],
            ],
            [
                'name' => 'Whey Protein Isolado',
                'description' => 'Whey Protein Isolado de chocolate (1Kg)',
                'price' => '21.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_top-whey-protein-isolado-1kg-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [3, 16],
            ],
            [
                'name' => 'Whey Protein Hidrolisado',
                'description' => 'Whey Protein Hidrolisado sem sabor (1Kg)',
                'price' => '28.74',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_whey-protein-hidrolisado-1kg-sabor-natural-growth-supplements.jpg',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [1, 16],
            ],
            [
                'name' => 'Basic Whey Sem Sabor',
                'description' => 'Basic Whey Sem Sabor (1Kg)',
                'price' => '9.90',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_basic-whey-protein-1kg-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [1],
            ],
            [
                'name' => 'Albumina 1Kg',
                'description' => 'Melhor custo-benefício ajuda na hipertrofia melhora recuperação muscular',
                'price' => '12.54',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_albumina-1kg-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [2],
            ],
            [
                'name' => 'Albumina 500g',
                'description' => 'Melhor custo-benefício ajuda na hipertrofia melhora recuperação muscular',
                'price' => '7.85',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_albumina-500g-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [2],
            ],
            [
                'name' => 'Barra de Proteína (Oreo)',
                'description' => 'Barra de Proteína (Oreo) C/12 unidades',
                'price' => '3.59',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_barra-de-prote-na-barrinha-de-prote-na-display-c-12-un-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [4],
            ],
            [
                'name' => 'Barra de Proteína (Amendoim)',
                'description' => 'Barra de Proteína (Amendoim) C/12 unidades',
                'price' => '3.59',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_barra-de-nuts-display-c-12-un-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [4, 7],
            ],
            [
                'name' => 'Barra de Proteína (Wafer)',
                'description' => 'Barra de Proteína (Wafer) C/12 unidades',
                'price' => '3.39',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_barra-wafer-protein-display-c-06-un-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [4, 7],
            ],
            [
                'name' => 'Barra de Proteína (Crisp)',
                'description' => 'Barra de Proteína (Crisp) C/12 unidades',
                'price' => '3.39',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_barra-crisp-com-whey-protein-display-c-12-un-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [4, 7],
            ],
            [
                'name' => 'Hiper Mass Chocolate (1Kg)',
                'description' => 'Hiper Mass Chocolate (1Kg) Alta concentração de energia substituidor de refeição',
                'price' => '5.76',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_hiper-mass-1kg-sabor-chocolate-growth-supplements-1.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [5],
            ],
            [
                'name' => '(TOP) Hiper Mass Chocolate (1Kg)',
                'description' => '(TOP) Hiper Mass Chocolate (1Kg) Alta concentração de energia substituidor de refeição',
                'price' => '8.76',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_top-hipercal-rico-sabor-chocolate-1kg-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [5],
            ],
            [
                'name' => 'Big Mass Pro (3Kg)',
                'description' => 'Big Mass Pro (3Kg) Alta concentração de energia substituidor de refeição',
                'price' => '11.76',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_big-mass-pro-hipercal-rico-3kg-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [5],
            ],
            [
                'name' => 'Maltodesxtrina (1Kg)',
                'description' => 'Maltodesxtrina (1Kg) Fornecedor de energia',
                'price' => '2.71',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_maltodextrina-1kg-growth-supplements-5.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [6],
            ],
            [
                'name' => 'Blend Vegan (1Kg)',
                'description' => 'Combate catabolismo estimula hipertrofia fonte de proteínas',
                'price' => '8.71',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_blend-vegan-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [8],
            ],
            [
                'name' => '3W Whey Protein (1Kg)',
                'description' => '3W Whey Protein (1Kg) Blend de proteina diferentes tempos de absorção',
                'price' => '12.41',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_3-whey-protein-1kg-growth-supplements.jpg',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [1, 8],
            ],
            [
                'name' => 'Creatina Monohidratada (250g)',
                'description' => 'Estimula a hipertrofia e auxilia a recuperação muscular aumento de força',
                'price' => '19.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_creatina-monohidratada-250g-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [9],
            ],
            [
                'name' => 'Creatina creapure (250g)',
                'description' => 'Estimula a hipertrofia e auxilia a recuperação muscular aumento de força',
                'price' => '23.59',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_creatina-250g-creapure-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [9],
            ],
            [
                'name' => 'L-Glutamina (250g)',
                'description' => 'Estimula a hipertrofia e auxilia a recuperação muscular aumento de força',
                'price' => '7.59',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_l-glutamina-250g-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [9],
            ],
            [
                'name' => 'Beta-Alanina em Pó (250g)',
                'description' => 'Estimula a hipertrofia e auxilia a recuperação muscular aumento de força',
                'price' => '5.59',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_beta-alanina-em-p-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [9],
            ],
            [
                'name' => 'Creatina Creapure 120 Comprimidos',
                'description' => 'Estimula a hipertrofia e auxilia a recuperação muscular aumento de força',
                'price' => '11.29',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_creatina-creapure-120-comprimidos-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [9],
            ],
            [
                'name' => 'Panqueca Proteica (450g)',
                'description' => 'Panqueca Proteica sabor Natural (450g)',
                'price' => '4.39',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_panqueca-proteica-growth-sabor-natural-420gr.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [10],
            ],
            [
                'name' => 'D-Ribose (300g)',
                'description' => 'Fornece energia previne a fadiga pré treino',
                'price' => '11.19',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_d-ribose-300gr-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [10],
            ],
            [
                'name' => 'Multivitaminico (120cáps)',
                'description' => 'Complemento diário fitonutrientes importantes',
                'price' => '4.60',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_multivitam-nico-120-c-ps-nova-f-rmula-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [11, 13],
            ],
            [
                'name' => 'Vitamina B12 (120cáps)',
                'description' => 'Complemento diário fitonutrientes importantes',
                'price' => '4.66',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_vitamina-b12-com-120-c-psulas-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [11, 12],
            ],
            [
                'name' => 'Vitamina C (120Cáps)',
                'description' => 'Complemento diário fitonutrientes importantes',
                'price' => '3.46',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_vitamina-c-120-caps-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [11],
            ],
            [
                'name' => 'L-Carnitina (200g)',
                'description' => 'Auxilia redução peso auxilia na formação de energia',
                'price' => '13.99',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_l-carnitina-200g-growth-supplements-1.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [14],
            ],
            [
                'name' => 'Pré-Treino Haze (300g)',
                'description' => 'Mais Disposição e força na hora do treino',
                'price' => '23.99',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_pr-treino-haze-hardcore-300gr-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [15, 19],
            ],
            [
                'name' => 'Pré-Treino Insanity (300g)',
                'description' => 'Mais Disposição e força na hora do treino',
                'price' => '27.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_pr-treino-insanity-300g-growth-supplements-4.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [15, 19],
            ],
            [
                'name' => 'Óleo de Peixe Ultra (75 softgel)',
                'description' => 'Contribui para hipertrofia melhora a recuperação pós treino',
                'price' => '3.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_leo-de-peixe-ultra-75-softgel-growth-supplements.webp',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [17],
            ],
            [
                'name' => 'Shaker Preta (600ml)',
                'description' => 'Praticidade estilo economia',
                'price' => '1.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_coqueteleira-simples-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [18],
            ],
            [
                'name' => 'Shaker Rosa (600ml)',
                'description' => 'Praticidade estilo economia',
                'price' => '1.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_coqueteleira-simples-rosa-growth-supplements.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [18],
            ],
            [
                'name' => 'Galão Preto 2 Litros',
                'description' => 'Praticidade estilo economia',
                'price' => '1.89',
                'photo_1' => 'https://www.gsuplementos.com.br/upload/produto/imagem/m_gal-o-preto-2-litros-growth-supplements-1.png',
                'photo_2' => '',
                'quantity' => '10',
                'subcategory_ids' => [18],
            ],
        ];

        foreach ($productsToCreate as $productData) {
            // Remover subcategory_ids temporariamente do array de dados do produto
            $subcategoryIds = $productData['subcategory_ids'];
            unset($productData['subcategory_ids']);

            // Criar o produto
            $product = Product::create($productData);

            // Associar subcategorias ao produto
            $product->subcategories()->attach($subcategoryIds);
        }
    }
}
