@extends('layouts.admin')
@section('content')
   @include('includes.flash_message')
    <h1>Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach ($users as $user)
                {{-- {{dd($user->photo)}} --}}
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img src="{{$user->photo?$user->photo->file:'https://via.placeholder.com/400x400'}}" height="100" alt=""></td>
                        <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->is_active === 1 ? 'Active':'Not Active'}}</td>
                        <td>{{$user->created_at->diffforHumans()}}</td>
                        <td>{{$user->updated_at->diffforHumans()}}</td>
                     </tr>  
                @endforeach
            @endif
        </tbody>
      </table>
@endsection