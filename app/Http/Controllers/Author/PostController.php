<?php

namespace App\Http\Controllers\Author;

use App\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Brian2694\Toastr\Facades\Toastr;

use App\Notifications\NewAuthorPost;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Auth::User()->posts()->latest()->paginate(5);
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',

            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImg = Image::make($image)->fit(980,555)->stream();
            Storage::disk('public')->put('post/'.$imgName,$postImg);

        } else {
            $imgName = "default.png";
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imgName;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        } else {
            $post->status = false;
        }

        $post->is_approved = false;

        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        // Email Notification
        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));
        
        Toastr::success('Yoi berhasil bikin postingan sob :)' , 'success');
        return redirect()->route('author.post.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
        if($post->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
        if($post->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
        if($post->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',

            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            // apus image lama
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

            $postImg = Image::make($image)->fit(980,555)->stream();
            Storage::disk('public')->put('post/'.$imgName,$postImg);

        } else {
            $imgName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imgName;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        } else {
            $post->status = false;
        }

        $post->is_approved = false;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        
        Toastr::success('Yoi berhasil ngedit postingan sob :)' , 'success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
        if($post->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        return redirect()->back();
    }

    public function searchPostAuthor(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $posts = Auth::User()->posts()->where('title', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('author.post.index', compact('posts'));
    }
}
