<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    //
    public function index()
    {
        $authors = User::authors()->withCount('posts')->paginate(5);
        return view('admin.author.index', compact('authors', 'posts'));
    }

    public function destroy($id)
    {
        //
        $author = User::findOrFail($id);
        $author->delete();

        return redirect()->back();
    }

    public function searchAuthor(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $authors = User::where('name', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('admin.author.index', compact('authors'));
    }
}