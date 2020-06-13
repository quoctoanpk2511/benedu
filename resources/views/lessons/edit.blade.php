@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="mt-2">
        Edit Lesson
        </h2>
    </div>
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
        <form action="{{ route('lessons.update', $lesson->id)  }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{ isset($lesson) ? $lesson->title : '' }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" class="form-control" name="description" value="{{ isset($lesson) ? $lesson->description : '' }}">
            </div>
            <div class="form-group">
            <button class="btn btn-success">
                Update Lesson
            </button>
            </div>
        </form>
    </div>
</div>
@endsection