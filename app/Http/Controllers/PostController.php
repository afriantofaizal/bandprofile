<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->approved()->published()->paginate(5);

        $categories = Category::withCount('posts')->get();

        $tags = Tag::all();

        return view('post.index', compact('posts', 'categories', 'tags'));

    }

    public function detail($slug)
    {
        $post = Post::where('slug',$slug)->approved()->published()->first();

        $category = Category::where('slug',$slug)->first();

        // url abort
        $countPost = Post::where(['slug'=>$slug])->count();
        if ($countPost==0){
            abort(404);
        }

        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }

        $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();

        return view('post.post',compact('post','randomposts', 'category'));

    }

    public function postByCategory($slug)
    {
        $countCategory = Category::where(['slug'=>$slug])->count();
        if ($countCategory==0){
            abort(404);
        }

        // show categories choose
        $categories = Category::all();

        // show index category
        $category = Category::where('slug', $slug)->first();

        // show all post by category where approved and published
        $posts = $category->posts()->latest()->approved()->published()->paginate(5);

        $counted = $posts->total();

        return view('post.category', compact('category', 'categories', 'posts', 'counted'));
    }

    public function postByTag($slug)
    {
        $countTag = Tag::where(['slug'=>$slug])->count();
        if ($countTag==0){
            abort(404);
        }

        // show categories choose
        $categories = Category::all();

        $category = Category::where('slug', $slug)->first();

        $tag = Tag::where('slug', $slug)->first();

        // show all post by category where approved and published
        $posts = $tag->posts()->latest()->approved()->published()->paginate(5);

        return view('post.tag', compact('categories', 'tag', 'category', 'posts'));
    }


    // limit string preserve html tags
    public function substr_text_only($string, $limit, $end='...')
    {
        $with_html_count = strlen($string);
        $without_html_count = strlen(strip_tags($string));
        $html_tags_length = $with_html_count-$without_html_count;

        return str_limit($string, $limit+$html_tags_length, $end);
    }
}
