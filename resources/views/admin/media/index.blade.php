
@extends('layouts.admin')

@section('content')

    @if($photos)

    <h1>Media</h1>
    <table class='table table-hover'>
        <thead>
               <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Created</th>
               </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                    <tr>
                        <td>{{$photo->id}}</td>
                        <td><img height="50" src="{{$photo->file}}" alt=""/></td>
                        <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
                    </tr>
            @endforeach
        </tbody>
    </table> 

    @endif  

@stop