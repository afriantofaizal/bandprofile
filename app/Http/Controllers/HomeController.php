<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; 
use App\Post;
use App\Gallery;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();
        $galleries = Gallery::approved()->published()->take(3)->inRandomOrder()->get();
        return view('welcome', compact('categories', 'randomposts', 'galleries'));
    }

}
