<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    //
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(5);
        return view('admin.subscriber', compact('subscribers'));
    }

    public function destroy($subscriber)
    {
        $subscriber = Subscriber::findOrFail($subscriber);
        $subscriber->delete();

        return redirect()->back();
    }

    public function searchsub(Request $request)
    {
        $this->validate($request,[
            'query' => 'required',
        ]);

        $query = $request->get('query');
        $subscribers = Subscriber::where('email', 'LIKE', '%'.$query.'%')->paginate(5);
        
        return view('admin.subscriber', compact('subscribers'));
    }
}
