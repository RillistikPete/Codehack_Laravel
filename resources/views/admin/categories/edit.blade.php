@extends('layouts.admin')


@section('content')
    

    <h1>Categories</h1>

    <div class="col-sm-6">

        {!! Form::model($category, ['method'=>'POST', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
        <div class='form-group'>
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form control']) !!}
        </div>
        <div class="form-group">
        {!! Form::submit('Create Category', null, ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-sm-6">

        @if($categories)
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created Date</th>
                </tr>
            </thead>
        <tbody>

            @foreach ($categories as $categ)
                <tr>
                    <td>{{$categ->id}}</td>
                    <td>{{$categ->name}}</td>
                    <td>{{$categ->created_at ? $categ->created_at->diffForHumans() : 'No date'}}</td>
                </tr>
            @endforeach
        
        </tbody>
        </table>

        @endif

    </div>










@endsection