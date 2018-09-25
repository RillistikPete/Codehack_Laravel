@extends('layouts.admin')


@section('content')

    <h1>Edit User</h1>

  {{-- !!! $user->id  is required below to work for index.blade.php  {{route('users.edit', $user->id)}} --}}
  {{-- convert to model, pass in $user, this allows for access --}}

    <div class="col-sm-9">
        <img class="img-rounded" height="200px" width="200px" src="{{$user->photo ? $user->photo->file : '/images/placeholder.jpg'}}" alt="">
    </div>

    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

        <div class='form-group'>
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form control']) !!}
        </div>
        
        <div class='form-group'>
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose An Option'] + $roles, null, ['class'=>'form control']) !!}
        </div>
       
        <div class='form-group'>
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Offline') ,null, ['class'=>'form control']) !!}
        </div>
        
        <div class='form-group'>
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form control']) !!}
        </div>
        
        <div class='form-group'>
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::submit('Create User', null, ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}



    @include('includes.form_error')
       

@stop