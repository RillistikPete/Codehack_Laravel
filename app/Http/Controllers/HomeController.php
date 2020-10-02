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
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $postComments = Post::with('comments')->orderBy('created_at', 'desc')->get();
        $comments = Comment::all();
        $categories = Category::all();
        return view('front/home', compact('posts', 'user', 'comments', 'categories', 'postComments'));
        //removed 'post' and 'year' from compact - heroku dep
    }

    //this is for post.blade.php
    public function post($slug){

        $user = Auth::user();
        $post = Post::findBySlug($slug);
        $categories = Category::all();
        $comments = $post->comments()->whereIsActive(1)->get();
        
        return view('post', compact('post', 'comments', 'categories', 'user'));

    }

    public function categPosts($id){

        $user = Auth::user();
        $category = Category::with('posts')->orderBy('name', 'asc');
        $categories = Category::all();
        $posts = Post::where('category_id', '=', $id)->paginate(10);
        //$posts = $categories->paginate(10);
        return view('front/categ-posts', compact('posts', 'categories', 'category', 'user'));

    }

    // public function userCreatePost() {

    //     $user = Auth::user();
    //     $categories = Category::pluck('name', 'id')->all();
    //     return view('front.user-create-post', compact('categories', 'user'));
        
    // }

    
}
