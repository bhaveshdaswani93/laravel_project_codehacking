@extends('layouts.admin')
@section('content')
    <h1>Edit Category</h1>
    <div class="row">
        {!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Category',['class'=>'btn btn-primary col-sm-6']) !!}
        </div>

        {!! Form::close() !!}
        
            {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category',['class'=>'btn btn-danger col-sm-6']) !!}
            </div>
            {!! Form::close() !!}
        
    </div>
    <div class="row">
        <div class="space-6"></div>
        @include('includes.form_error')
    </div>
@endsection