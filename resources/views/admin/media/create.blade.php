
@extends('layouts.admin')



{{-- this way, styles and scripts are only run on this page --}}
@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/basic.min.css">

@endsection

@section('content')


    <h1>Upload Media</h1>
        <br>
    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@store', 'class'=>'dropzone', 'style'=>'border:1px solid black;']) !!}
        <br>
        <br>
    {!! Form::close() !!}


@section('scripts')
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

@endsection

@stop