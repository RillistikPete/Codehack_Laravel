<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $posts = Post::paginate(2);
        return view('front/home', compact('posts', 'user'));
    }
}
