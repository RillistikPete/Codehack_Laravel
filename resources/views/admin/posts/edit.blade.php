@extends('layouts.admin')



@section('content')
    

<h1>Edit Post</h1>

<div class="row">

        <div class="col-sm-6">

            <img src="{{$post->photo->file}}" alt="" class="img-responsive">

        </div>
        
        <div class="col-sm-6">

            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files' => true]) !!}
            <div class='form-group'>
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form control']) !!}
            </div>

            <div class='form-group'>
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form control']) !!}
            </div>

            <div class='form-group'>
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form control']) !!}
            </div>

            <div class='form-group'>
            {!! Form::label('body', 'Description:') !!}
            {!! Form::textarea('body', null, ['class'=>'form control']) !!}
            </div>


            {!! Form::submit('Update', null, ['class'=>'btn btn-primary']) !!}
            {!! Form::close()!!}

            <div class='form-group'>
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
            <div class='form-group'>
            {!! Form::submit('Delete', null, ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            </div>

        </div>

</div>

</div>

    <div class="row">
        @include('includes.form_error')
    </div>


@endsection
