<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $products = [
            [
                'name' => 'Smartphone Android',
                'slug' => 'smartphone-android',
                'description' => 'Smartphone Android haute performance avec écran 6.5" et triple caméra.',
                'price' => 150000,
                'compare_price' => 180000,
                'stock' => 50,
                'sku' => 'PHN-001',
                'image' => 'products/smartphone.jpg',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'electronique')->first()->id,
            ],
            [
                'name' => 'T-Shirt Casual',
                'slug' => 't-shirt-casual',
                'description' => 'T-shirt 100% coton, confortable et stylé pour toutes occasions.',
                'price' => 7500,
                'compare_price' => null,
                'stock' => 100,
                'sku' => 'TSH-001',
                'image' => 'products/tshirt.jpg',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'mode')->first()->id,
            ],
            [
                'name' => 'Coussin Décoratif',
                'slug' => 'coussin-decoratif',
                'description' => 'Coussin décoratif pour salon, 40x40 cm, matière douce.',
                'price' => 12000,
                'compare_price' => 15000,
                'stock' => 30,
                'sku' => 'CSN-001',
                'image' => 'products/coussin.jpg',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'maison')->first()->id,
            ],
            [
                'name' => 'Ballon de Football',
                'slug' => 'ballon-football',
                'description' => 'Ballon de football officiel taille 5, qualité professionnelle.',
                'price' => 25000,
                'compare_price' => null,
                'stock' => 20,
                'sku' => 'BLN-001',
                'image' => 'products/ballon.jpg',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'sport')->first()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
