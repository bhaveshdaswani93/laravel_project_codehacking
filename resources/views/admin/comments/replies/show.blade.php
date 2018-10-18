@extends('layouts.admin')
@section('content')
@if (count($replies)>0)
<h1>Replies</h1>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($replies as $reply)
            <tr>
                <td>{{$reply->id}}</td>
                <td>{{$reply->author}}</td>
                <td>{{$reply->email}}</td>
                <td>{{$reply->body}}</td>
                <td><a href="{{route('home.post',$reply->comment->post->id)}}">View Post</a></td>
                <td>
                    {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id] ]) !!}
                        @if ($reply->is_active===1)
                            {!! Form::hidden('is_active',0) !!}
                            {!! Form::submit('Un-approve',['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::hidden('is_active',1) !!}
                            {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}
                        @endif

                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=> ['CommentRepliesController@destroy',$reply->id] ]) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<h1 class="text-center">No Replies</h1>    
@endif

@endsection