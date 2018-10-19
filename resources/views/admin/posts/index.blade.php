@extends('layouts.admin')
@section('content')
    <h1>Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if (count($posts)>0)
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img height="100" src="{{$post->photo?$post->photo->file:"https://via.placeholder.com/400x400"}}" alt=""></td>
                    <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
                        <td>{{$post->category?$post->category->name:"Uncategorizes post"}}</td>
                        
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td><a href="{{route('home.post',$post->slug)}}">View Post</a></td>
                    <td><a href="{{route('admin.comments.show',$post->id)}}">View Comments</a></td>
                        <td>{{$post->created_at->diffforHumans()}}</td>
                        <td>{{$post->updated_at->diffforHumans()}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@endsection()