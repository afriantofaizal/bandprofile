<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\Facades\Hash;

use Brian2694\Toastr\Facades\Toastr;

class SettingsController extends Controller
{
    //
    public function index()
    {
        return view('author.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image))
        {
            // bikin nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imgName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // cek dir kalo ada
            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            // apus image lama
            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            // resize image category trus upload
            $profileImage = Image::make($image)->fit(300,300)->stream();
            Storage::disk('public')->put('profile/'.$imgName,$profileImage);

            } else{
                $imgName = $user->image;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $imgName;
            $user->about = $request->about;

            $user->save();
            
            Toastr::success('Yoi berhasil ngedit Profil sob :)' , 'success');
            return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        // dd('aac');
        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $hashedPassword))
        {
            if(!Hash::check($request->password, $hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Yoi berhasil ganti Password sob :)', 'success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('Sorry password gagal diganti :(', 'error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Password gak sama :(', 'error');
            return redirect()->back();
        }
    }
}
