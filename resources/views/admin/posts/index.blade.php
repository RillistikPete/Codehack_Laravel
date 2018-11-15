@extends('layouts.admin')



@section('content')
    

    <h1>Posts</h1>
    <hr>

    <table class="table table-hover">
            <thead>
                <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>View Post</th>
                <th>Comments</th>
                <th>Created</th>
                <th>Updated</th>
                </tr>
            </thead>
        <tbody>

            @if($posts)
            @foreach ($posts as $post)
                
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img src="{{$post->photo ? $post->photo->file : '/images/placeholder.jpg'}}" height="50" alt="Hi"/></td>
                    <td>{{$post->title}}</td>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                    <td>{{$post->category_id ? $post->category->name : 'Uncategorized'}}</td>

                    {{-- send slug here instead of post->id bc you want slug title in the url not number --}}
                    <td><a href="{{route('home.post', $post->slug)}}">View Post</td>
                    <td><a href="{{route('comments.show', $post->id)}}">View Comments</td>

                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            
            @endforeach
            @endif

        </tbody>

    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

                {{$posts->render()}}
                
        </div>
    </div>


@endsection