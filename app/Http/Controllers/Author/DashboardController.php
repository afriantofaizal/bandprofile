<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $galleries = $user->galleries;
        $totalPenPost = $posts->where('is_approved', false)->count();
        $totalPenGall = $galleries->where('is_approved', false)->count();
        $allViews = $posts->sum('view_count');

        return view('author.dashboard', compact('posts', 'galleries', 'totalPenPost', 'totalPenGall', 'allViews'));
    }

}
