<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AuthorGalleryApproved;

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
        $galleries = Gallery::latest()->paginate(5);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.gallery.create');
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

        $gallery->is_approved = true;
        $gallery->save();
        
        Toastr::success('Yoi berhasil bikin gallery sob :)' , 'success');
        return redirect()->route('admin.gallery.index');
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
        return view('admin.gallery.show', compact('gallery'));
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
        return view('admin.gallery.edit', compact('gallery'));
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

        $gallery->is_approved = true;
        
        $gallery->save();
        
        Toastr::success('Yoi berhasil ngedit gallery sob :)' , 'success');
        return redirect()->route('admin.gallery.index');

    }

    public function pending()
    {
        $galleries = Gallery::where('is_approved',false)->paginate(5);
        return view('admin.gallery.pending', compact('galleries'));
    }

    public function approval($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery->is_approved == false)
        {
            $gallery->is_approved = true;
            $gallery->save();

            $gallery->user->notify(new AuthorGalleryApproved($gallery));

        } else {
            Toastr::info('Gallery udah diapprove :)' , 'Info');
        }

        return redirect()->back();

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
        
        return view('admin.gallery.index', compact('galleries'));
    }

    public function searchPendingGall(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $galleries = Gallery::where('is_approved',false)
                            ->where('title', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('admin.gallery.index', compact('galleries'));
    }
}
