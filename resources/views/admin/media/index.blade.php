
@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if($photos)

    <form action="/delete/media" method="post" class="form-inline">

        {{ csrf_field() }}
        {{method_field('DELETE')}}

        <div class="form-group">
            <select name="checkboxArray" id="" class="form-control">
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn-primary">
        </div>

    


    <table class='table table-hover'>
        <thead>
               <tr>
                     <th><input type="checkbox" id="options"></th>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Created</th>
               </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                    <tr>
                        <td><input class="checkboxes" type="checkbox" name="checkboxArray[]" value="{{$photo->id}}"></td>
                        <td>{{$photo->id}}</td>
                        <td><img height="50" src="{{$photo->file}}" alt=""/></td>
                        <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
                            <div class='form-group'>
                              {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table> 

    </form> {{-- delete/media --}}


    @endif  

@stop