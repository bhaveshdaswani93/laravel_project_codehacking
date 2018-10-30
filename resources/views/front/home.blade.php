@extends('layouts.blog-home')

@section('content')
    <!-- First Blog Post -->
    @if (count($posts)>0)
        @foreach ($posts as $post)
            <h2>
                <a href="#">{{$post->title}}</a>
            </h2>
            <p class="lead">
                 by <a href="#">{{$post->user->name}}</a>
            </p>
        <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive" src="{{$post->photo?$post->photo->file:'http://placehold.it/900x300'}}" alt="">
            <hr>
            {!!str_limit($post->body, 100)  !!}
            <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
            <hr>
        @endforeach
        {!! $posts->links() !!}
    @else
        <h2>No Post</h2>
    @endif
    

@endsection
@section('sidebar')
    @include('includes.front_sidebar')
@endsection
