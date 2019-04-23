<?php

namespace App\Http\Controllers\Author;

use App\Gallery;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAuthorGallery;

use Brian2694\Toastr\Facades\Toastr;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galleries = Auth::User()->galleries()->latest()->paginate(5);
        return view('author.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('author.gallery.create');
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
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('gallery'))
            {
                Storage::disk('public')->makeDirectory('gallery');
            }

            $galleryImg = Image::make($image)->fit(980,555)->stream();
            Storage::disk('public')->put('gallery/'.$imgName,$galleryImg);


        } else {
            $imgName = "default.png";
        }

        $gallery = new Gallery();
        $gallery->user_id = Auth::id();
        $gallery->title = $request->title;
        $gallery->slug = $slug;
        $gallery->image = $imgName;

        if(isset($request->status))
        {
            $gallery->status = true;
        } else {
            $gallery->status = false;
        }

        $gallery->is_approved = false;

        $gallery->save();

        // Email Notification
        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorGallery($gallery));
        
        Toastr::success('Yoi berhasil bikin gallery sob :)' , 'success');
        return redirect()->route('author.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
        if($gallery->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }
        return view('author.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
        if($gallery->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        return view('author.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
        if($gallery->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('gallery'))
            {
                Storage::disk('public')->makeDirectory('gallery');
            }

            // apus image lama
            if(Storage::disk('public')->exists('gallery/'.$gallery->image))
            {
                Storage::disk('public')->delete('gallery/'.$gallery->image);
            }

            $galleryImg = Image::make($image)->fit(980,555)->stream();
            Storage::disk('public')->put('gallery/'.$imgName,$galleryImg);

        } else {
            $imgName = $gallery->image;
        }

        $gallery->user_id = Auth::id();
        $gallery->title = $request->title;
        $gallery->slug = $slug;
        $gallery->image = $imgName;

        if(isset($request->status))
        {
            $gallery->status = true;
        } else {
            $gallery->status = false;
        }

        $gallery->is_approved = false;

        $gallery->save();
        
        Toastr::success('Yoi berhasil ngedit gallery sob :)' , 'success');
        return redirect()->route('author.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
        if($gallery->user_id != Auth::id())
        {
            Toastr::error('Heh kamu gak boleh ke halaman tujuan', 'Error');
            return redirect()->back();
        }

        if(Storage::disk('public')->exists('gallery/'.$gallery->image))
        {
            Storage::disk('public')->delete('gallery/'.$gallery->image);
        }

        $gallery->delete();

        return redirect()->back();
    }

    public function searchGall(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $galleries = Gallery::where('title', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('author.gallery.index', compact('galleries'));
    }
}
