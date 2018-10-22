@extends('layouts.blog-post')
@section('content')
    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">{{$post->user->name}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="{{$post->photo?$post->photo->file:$post->photoPlaceHolder()}}" alt="">

            <hr>

            <!-- Post Content -->
            {!!$post->body!!}

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @include('includes.flash_message')
            @if(Auth::check())
            <div class="well">
                <h4>Leave a Comment:</h4>
                {{-- <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> --}}
                {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}
                    {!! Form::hidden('post_id',$post->id) !!}
                    <div class="form-group">
                        {{-- {!! Form::label('body','Comment') !!} --}}
                        {!! Form::textarea('body',null,['rows'=>3,'class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
            @endif
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
           @if(count($comments)>0)
            @foreach ($comments as $comment)
            <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" 
                        height="64"
                        src="{{$comment->photo?$comment->photo:'http://placehold.it/64x64'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>
                                                    {{$comment->created_at->diffForHumans()}}
                            </small>
                        </h4>
                        <p>
                            {{$comment->body}}
                        </p>
                        @if($replies = $comment->replies()->whereIsActive(1)->get())
                            @foreach ($replies as $reply)
                            <div id='nested-reply' class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="{{$reply->photo?$reply->photo:'http://placehold.it/64x64'}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                    <p>{{$reply->body}}</p>
                                    </div>
                                </div>
                               


                                      
                            @endforeach
                        
                        @endif
                        <div class="comment-reply-container">
                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                <div class="reply-container col-sm-10">
                                        {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@storeReply']) !!}
                                        {!! Form::hidden('comment_id',$comment->id) !!}
                                        <div class="form-group">
                                            {!! Form::label('body','Reply') !!}
                                            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>1]) !!}
                                        </div>
                                        {!! Form::submit('submit reply',['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!} 

                                </div>
                                

                            </div>
                       
                    </div>
            </div>
            
            @endforeach
           @endif
    </div>
                   

            <!-- Comment -->
            

        

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>

        </div>
@endsection
@section('scripts')
    <script>
        $('.comment-reply-container .toggle-reply').click(function(){
            $(this).next().slideToggle('slow')
        })
    </script>
@endsection