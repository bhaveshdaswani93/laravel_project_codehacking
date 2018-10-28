<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Http\Requests\PostsCreateRequest;

use \Illuminate\Support\Facades\Auth;

use App\Photo;

use App\Category;

use App\Http\Requests\PostsEditRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(2);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->toArray();
        return view('admin.posts.create',compact('categories'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        // return $request->all();
        //one
        dd($request->file('photo_id'));
        $user = Auth::user();
        $input = $request->all();
        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);
        return redirect('/admin/posts');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        // dd($post);
        $categories = Category::pluck('name','id')->toArray();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(PostsEditRequest $request, $id)
    {
        //
        // return $request->all();
        $input = $request->all();
        $user = Auth::user();
        self::storePhoto($request,$input);
        $user->posts()->whereId($id)->first()->update($input);
        return redirect('/admin/posts');
    }

    public static function storePhoto($request,&$input)
    {
        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
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
        // return "reached successfully";
        $post = Post::findOrFail($id);
        if($post->photo)
        {
            unlink(public_path().$post->photo->file);
        }
        $post->delete();
        return redirect('/admin/posts');
    }

    public function post($slug)
    {
        // $post = Post::findOrFail($id);
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post',compact('post','comments'));
    }
}
