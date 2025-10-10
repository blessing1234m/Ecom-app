<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::where('is_published', true)->latest()->paginate(8);
        return view('front.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog): View
    {
        abort_unless($blog->is_published, 404);
        return view('front.blogs.show', compact('blog'));
    }
}
