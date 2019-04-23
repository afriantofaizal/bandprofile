<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")->approved()->published()->paginate(5);
        // dd($posts);
        $categories = Category::all();
        return view('post.search', compact('posts', 'query', 'categories'));
    }
}
