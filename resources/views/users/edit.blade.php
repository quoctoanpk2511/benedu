@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h2 class="mt-2">My Profile</h2></div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
        </div>

        @if(isset($user->avatar))
            <div class="form-group">
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="" width="200px">
            </div>
        @endif

        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" name="avatar" id='avatar'>
        </div>

        <div class="form-group">
            <label for="about">About Me</label>
            <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>
@endsection