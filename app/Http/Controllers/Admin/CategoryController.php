<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
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
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        // tangkep data dari form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            // bikin nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // cek dir kalo ada
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // resize image category trus upload
            $category = Image::make($image)->fit(1350,270)->stream();
            Storage::disk('public')->put('category/'.$imgName,$category);

            // 
            // cek category slider
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // resize image category slider trus upload
            $slider = Image::make($image)->fit(267,400)->stream();
            Storage::disk('public')->put('category/slider/'.$imgName,$slider);

        } else{
            $imgName = "default.png";
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imgName;

        $category->save();
        Toastr::success('Yoi berhasil bikin kategori sob :)' , 'success');
        return redirect()->route('admin.category.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        $this->validate($request, [
        'name' => 'required',
        'image' => 'mimes:jpg,bmp,png,jpeg'
        ]);

        // tangkep data dari form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);

        if(isset($image)){
            // bikin nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // cek dir kalo ada
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // apus image lama
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            // resize image category trus upload
            $categoryImage = Image::make($image)->fit(1350,270)->stream();
            Storage::disk('public')->put('category/'.$imgName,$categoryImage);

            // cek category slider
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // apus image slider lama
            if(Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            // resize image category slider trus upload
            $slider = Image::make($image)->fit(267,400)->stream();
            Storage::disk('public')->put('category/slider/'.$imgName,$slider);
    
            } else{
                $imgName = $category->image;
            }
    
            $category->name = $request->name;
            $category->slug = $slug;
            $category->image = $imgName;
    
            $category->save();
            
            Toastr::success('Yoi berhasil ngedit kategori sob :)' , 'success');
            return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);

        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();

        return redirect()->back();
    }

    public function searchCategory(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $categories = Category::where('name', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('admin.category.index', compact('categories'));
    }

}
