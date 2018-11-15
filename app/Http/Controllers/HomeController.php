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
        $posts = Post::paginate(1);
        $postComments = Post::with('comments')->get();
        $comments = Comment::all();
        $categories = Category::all();
        return view('front/home', compact('posts', 'user', 'comments', 'categories', 'year', 'postComments'));
    }

        //this is for post.blade.php
        public function post($slug){

            $post = Post::findBySlug($slug);
            $categories = Category::all();
            $comments = $post->comments()->whereIsActive(1)->get();
            
            return view('post', compact('post', 'comments', 'categories'));
    
        }
}
