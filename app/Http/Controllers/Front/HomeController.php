<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;


class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::active()->ordered()->get();
        $categories = Category::withCount('products')->active()->get();
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('front.home', compact('banners', 'categories', 'featuredProducts'));
    }
}
