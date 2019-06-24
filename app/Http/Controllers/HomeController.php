<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Category;
use Carbon\Carbon;
use Auth;


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

        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->paginate(1);
        $postComments = Post::with('comments')->orderBy('created_at', 'desc')->get();
        $comments = Comment::all();
        $categories = Category::all();
        return view('front/home', compact('posts', 'post', 'user', 'comments', 'categories', 'year', 'postComments'));
    }

    //this is for post.blade.php
    public function post($slug){

        $user = Auth::user();
        $post = Post::findBySlug($slug);
        $categories = Category::all();
        $comments = $post->comments()->whereIsActive(1)->get();
        
        return view('post', compact('post', 'comments', 'categories', 'user'));

    }

    public function categPosts(){

        $user = Auth::user();
        $posts = Post::where('category_id')->paginate(10);
        $categories = Category::with('posts')->get();
        //$posts = $categories->paginate(10);
        return view('front/categ-posts', compact('posts', 'categories', 'user'));

    }

    // public function userCreatePost() {

    //     $user = Auth::user();
    //     $categories = Category::pluck('name', 'id')->all();
    //     return view('front.user-create-post', compact('categories', 'user'));
        
    // }

    
}
