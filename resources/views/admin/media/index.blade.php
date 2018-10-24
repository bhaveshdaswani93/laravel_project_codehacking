@extends('layouts.admin')
@section('content')
    <h1>Media</h1>
    @include('includes.flash_message')
    {!! Form::open(['method'=>'POST','route'=>'admin.med.delete']) !!}
    {{-- {!! Form::open(['method'=>'POST','url'=>'/media/delete']) !!} --}}
    {!! Form::select('action',['delete'=>'Delete'],null,['class'=>'form-control']) !!}
    {!! Form::submit('Delete',['class'=>'btn btn-primary','name'=>'delete_all']) !!}
    <table class="table">
        <thead>
            <tr>
                <td>{!! Form::checkbox('delete',null,false,['class'=>'delete','id'=>'option']) !!}</td>
                <td>Id</td>
                <td>Photo</td>
                <td>Created</td>
            </tr>
        </thead>
        <tbody>
            @if (count($photos) > 0)
                @foreach ($photos as $photo)
                    <tr>
                        <td>{!! Form::checkbox('deleteMedia[]',$photo->id,false,['class'=>'checkboxes']) !!}</td>
                        <td>{{$photo->id}}</td>
                        <td><img height="100" src="{{$photo->file}}" alt=""></td>
                        <td>{{$photo->created_at?$photo->created_at->diffforHumans():"No Date"}}</td>
                        <td>
                            {{-- {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$photo->id]]) !!} --}}
                            {!! Form::hidden('photoId',$photo->id) !!}
                                {!! Form::submit('Delete',['class'=>'deleteOne btn btn-danger','name'=>'delete_one']) !!}
                            {{-- {!! Form::close() !!} --}}
                        </td>
                    </tr>
                @endforeach
                
            @endif
        </tbody>
    </table>
    {!! Form::close() !!}
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#option').click(function(){
                if(this.checked) {
                    $('.checkboxes').each(function(){
                        this.checked = true;
                    })
                } else {
                    $('.checkboxes').each(function(){
                        this.checked = false;
                    })
                }
            })
            $('.deleteOne').click(function(){
                let photoId = ($(this).prev().val());
                $('input[name=photoId]').val(photoId);
            })
        })
    </script>
@endsection
