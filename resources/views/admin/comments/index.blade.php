@extends('layouts.admin')
@section('content')
    
    @if (count($comments)>0)
    <h1>Comments</h1>
        <table class="table">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Author</td>
                    <td>Email</td>
                    <td>Body</td>

                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post',$comment->post->id)}}">View Post</a></td>
                    <td><a href="{{route('admin.comment.replies.show',$comment->id)}}">View replies</a></td>
                    <td>
                        {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}
                        @if ($comment->is_active === 1)
                            {!! Form::hidden('is_active',0) !!}
                            {!! Form::submit('Un-Approve',['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::hidden('is_active',1) !!}
                            {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}
                        @endif
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id] ]) !!}
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments found</h1>
    @endif
@endsection