@extends('layouts.blog-home')

@section('content')

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <!-- First Blog Post -->   

        @if ($posts)
            
            @foreach ($posts as $post)
                

                <h2>
                    <a href="#">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Created {{$post->created_at->diffForHumans()}}</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>

                <p>
                    {!!str_limit($post->body , 200)!!}
                </p>

                <a class="btn btn-primary" href="/post/{{$post->slug}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                {{-- COMMENTS SECTION DONE MANUALLY, NO DISQUS --}}
        
                     @if(Session::has('comment_message'))
        
                        {{Session('comment_message')}}
        
                    @endif
        
                    <!-- Blog Comments -->
        
                @if(Auth::check())
        
                    <!-- Comments Form -->
                    <div class="well">
        
                        <h4>Leave a Comment:</h4>
                        
                        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
        
                        <input type="hidden" name="post_id" value="{{$post->id}}">
        
        
                            <div class='form-group'>
                            {!! Form::label('body', 'Body:') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                            </div>
                            <div class='form-group'>
                            {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
        
                    </div>
                @endif
        
                    <hr>
        
        
                    <!-- Posted Comments -->
        
                @if(count($comments) > 0)
                
        
                    <!-- Comment -->
                    @foreach ($comments as $comment)
                        
                    <div class="media">
                        <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->author}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h4>
                           <p>{{$comment->body}}</p>
                            
        
                           @if(count($comment->replies) > 0)
        
                            @foreach ($comment->replies as $reply)
                                
                                @if ($reply->is_active == 1)
        
                                    <!-- Nested Comment -->
                                    <div id="nested-comment" class="media">
                                        <a class="pull-left" href="#">
                                        <img class="media-object" height="64" src="{{$reply->photo}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$reply->author}}
                                                <small>{{$reply->created_at->diffForHumans()}}</small>
                                            </h4>
                                            <p>{{$reply->body}}</p>
                                        </div>
        
                                            <div class="comment-reply-container">
                                
                                                    <button class="pull-right btn btn-primary toggle-reply">Reply</button>
        
                                                    <div class="comment-reply col-sm-6" style="display:none;">
                                                        
                                                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
        
                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    
                                                            <div class='form-group'>
                                                            {!! Form::label('body', 'Body:') !!}
                                                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                                            </div>
                                                            <div class='form-group'>
                                                            {!! Form::submit('Submit', null, ['class'=>'btn btn-primary']) !!}
                                                            </div>
                                                        {!! Form::close() !!}
        
                                                    </div>
                                            </div>
                                    </div>
                                    <!-- End Nested Comment -->
        
                                @else 
                                    <h1>No Replies</h1>   
        
                                @endif
        
                            @endforeach
        
                            @endif
        
        
                        </div>
                    </div>
                    
                    @endforeach
        
                @endif

            @endforeach

        @endif



    </div>

        <!-- Pagination -->

</div>

</div>
<!-- Blog Sidebar Widgets Column -->
@include('includes.front-sidebar')

@endsection
