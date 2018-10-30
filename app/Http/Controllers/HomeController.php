<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(1);
        $categories = Category::all();
        return view('front.home',compact('posts','categories'));
    }

    public function post($slug)
    {
        // $post = Post::findOrFail($id);
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        $categories = Category::all();
        return view('post',compact('post','comments','categories'));
    }
}
