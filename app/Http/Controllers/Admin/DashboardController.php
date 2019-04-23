<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use App\Gallery;
use App\Subscriber;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $posts = Post::all()->count();
        $totalPenPost = Post::where('is_approved', false)->count();
        $allViews = Post::sum('view_count');
        $authorCount = User::where('role_id', 2)->count();
        $catCount = Category::all()->count();
        $tagCount = Tag::all()->count();
        $galCount = Gallery::all()->count();
        $totalPenGall = Gallery::where('is_approved', false)->count();
        $subCount = Subscriber::all()->count();

        return view('admin.dashboard', compact('posts', 'totalPenPost', 'allViews', 'authorCount', 'catCount', 'tagCount', 'galCount', 'totalPenGall', 'subCount'));
    }
}
