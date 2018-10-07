@extends('layouts.admin')
@section('content')
    <h1>Edit User</h1>
    <div class="row">
            <div class="col-sm-3">
                    <img src="{{$user->photo?$user->photo->file:'https://via.placeholder.com/400x400'}}" class="img-responsive img-rounded" alt="">
                </div>
                <div class="col-sm-9">
                        {!! Form::model($user,['method'=>'PUT','action'=>['AdminUsersController@update',$user->id],'files'=>'true']) !!}
                        <div class="form-group">
                            {!! Form::label('name') !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email') !!}
                            {!! Form::email('email',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('role_id','Role') !!}
                            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('is_active','Status') !!}
                            {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('photo_id','Image') !!}
                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password') !!}
                            {!! Form::password('password',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Edit User',['class'=>'btn btn-info']) !!}
                        </div>
                </div>
    </div>
    
    <div class="row">
            @include('includes.form_error')
    </div>
   
    
@endsection