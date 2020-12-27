<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Http\Request;
use App\Post;
use App\Photo;
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
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-2'
        ]);
        $bucket = 'codehack-heroku-photos';
        $iterator = $s3Client->getIterator('ListObjects', array(
            'Bucket' => $bucket
        ));
        $arrayS3PicKeys = array();
        foreach ($iterator as $obj){
            array_push($arrayS3PicKeys, $obj['Key']);
        }
        //loop through keys and get url for each, push to array of urls, compact

        $s3ObjectsUrlArray = array();
        $presignedUrl;

        foreach ($arrayS3PicKeys as $key) {
            $url = $s3Client->getObjectUrl($bucket, $key);
            array_push($s3ObjectsUrlArray, $url);
        }
        echo "<script>console.log('s3ObjectsUrlArray - " . json_encode($s3ObjectsUrlArray) . "');</script>";

        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->paginate(9);
        $postComments = Post::with('comments')->orderBy('created_at', 'desc')->get();
        $comments = Comment::all();
        $categories = Category::all();

        return view('front/home', compact('posts', 'user', 'comments', 'categories', 'postComments', 'arrayS3PicKeys', 's3ObjectsUrlArray'));
        // return view('front/home', compact('posts', 'user', 'comments', 'categories', 'postComments'))->with(compact('s3urls'));

        //if you wish, you may pass an array of data as the second parameter given to the make method:
        //$view = View::make('greetings', $data);
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
        $posts = Post::where('category_id', '=', $id)->orderBy('created_at', 'desc')->paginate(5);
        //$posts = $categories->paginate(10);
        return view('front/categ-posts', compact('posts', 'categories', 'category', 'user'));

    }

    // public function userCreatePost() {

    //     $user = Auth::user();
    //     $categories = Category::pluck('name', 'id')->all();
    //     return view('front.user-create-post', compact('categories', 'user'));
        
    // }

    
}
