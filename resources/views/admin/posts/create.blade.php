@extends('layouts.admin')
@section('content')
<h1>Create Post</h1>
<div class="row">
        {!! Form::open(['method'=>'post','action'=>'AdminPostsController@store','files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id','Category') !!}
            {!! Form::select('category_id',[''=>'Select Category',0=>'Artist'],null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Photo') !!}
            {!! Form::file('photo_id') !!}
        </div>
        <div class="form-group">
            {!! Form::label('body') !!}
            {!! Form::textarea('body',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>
<div class="row">
    @include('includes.form_error')
</div>

@endsection