@extends('layouts.blog-home')

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url('useremail/send')}}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('textarea') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Your message: </label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="message" value="{{ old('message') }}">
                                </textarea>
                                @if ($errors->has('textarea'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('textarea') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="send" class="btn btn-info" value="Send" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'POST', 'action'=>['UserEmailController@send'], 'files' => true]) !!}
                {!! csrf_field() !!}
                <div class='form-group'>
                {!! Form::label('email', 'Email address:') !!}
                {!! Form::text('email', null, ['name'=>'email', 'class'=>'form-control']) !!}
                </div>

                <div class='form-group'>
                {!! Form::label('body', 'Your message:') !!}
                {!! Form::textarea('body', null, ['name'=>'message', 'class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Send', ['name'=>'send', 'class'=>'btn btn-primary']) !!}
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>



@endsection