<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Électronique',
                'slug' => 'electronique',
                'description' => 'Produits électroniques et gadgets'
            ],
            [
                'name' => 'Mode',
                'slug' => 'mode',
                'description' => 'Vêtements et accessoires'
            ],
            [
                'name' => 'Maison',
                'slug' => 'maison',
                'description' => 'Articles pour la maison'
            ],
            [
                'name' => 'Sport',
                'slug' => 'sport',
                'description' => 'Équipements sportifs'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
