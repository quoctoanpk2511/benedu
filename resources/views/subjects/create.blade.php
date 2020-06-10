@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="mt-2">
        {{ isset($subject)  ? 'Edit Subject' : 'Create Subject' }}
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
        <form action="{{ isset($subject) ? route('subjects.update', $subject->id) : route('subjects.store') }}" method="POST">
            @csrf
            @if(isset($subject))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" value="{{ isset($subject) ? $subject->name : '' }}">
            </div>
            <div class="form-group">
            <button class="btn btn-success">
                {{ isset($subject) ? 'Update Subject': 'Add Subject' }}
            </button>
            </div>
        </form>
    </div>
</div>
@endsection