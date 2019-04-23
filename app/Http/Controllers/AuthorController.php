<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Post;

class AuthorController extends Controller
{
    //
    public function profile($username)
    {
        // url abort
        $countUser = User::where(['username'=>$username])->count();
        if ($countUser==0){
            abort(404);
        }

        $author = User::where('username', $username)->first();
        $posts = $author->posts()->approved()->published()->paginate(5);
        $categories = Category::all();

        $counted = $posts->total();

        return view('profile.index', compact('author', 'posts', 'categories', 'counted'));
    }
}