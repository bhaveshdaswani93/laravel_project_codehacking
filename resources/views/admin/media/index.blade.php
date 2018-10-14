@extends('layouts.admin')
@section('content')
    <h1>Media</h1>
    @include('includes.flash_message')
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Photo</td>
                <td>Created</td>
            </tr>
        </thead>
        <tbody>
            @if (count($photos) > 0)
                @foreach ($photos as $photo)
                    <tr>
                        <td>{{$photo->id}}</td>
                        <td><img height="100" src="{{$photo->file}}" alt=""></td>
                        <td>{{$photo->created_at?$photo->created_at->diffforHumans():"No Date"}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$photo->id]]) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                
            @endif
        </tbody>
    </table>
@endsection
