<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

use \Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    //
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    public function create()
    {
        return view('admin.media.upload');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time().'___'.$file->getClientOriginalName();
        $file->move('images',$name);
        Photo::create(['file'=>$name]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->file);
        $photo->delete();
        Session::flash('success','Photo deleted with id '.$id);
        return redirect('/admin/media');
    }
}
