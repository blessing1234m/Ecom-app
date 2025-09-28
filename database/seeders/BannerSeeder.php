<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            [
                'title' => 'Bienvenue sur Ecom-App',
                'description' => 'Découvrez nos produits exceptionnels aux meilleurs prix',
                'image' => 'banners/banner1.jpg',
                'button_text' => 'Acheter maintenant',
                'button_link' => '/products',
                'order' => 1,
            ],
            [
                'title' => 'Promotions Spéciales',
                'description' => 'Jusqu\'à 50% de réduction sur une sélection de produits',
                'image' => 'banners/banner2.jpg',
                'button_text' => 'Voir les promotions',
                'button_link' => '/products?promo=true',
                'order' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
