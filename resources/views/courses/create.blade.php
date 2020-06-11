@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="mt-2">
        {{ isset($course) ? 'Edit Course': 'Create New Course' }}
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
    <form action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($course))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id='title' value="{{ isset($course) ? $course->title: '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($course) ? $course->description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="pubished_at">Pubished At</label>
                <input type="text" class="form-control" name="published_at" id='published_at' value="{{ isset($course) ? $course->published_at : '' }}">
            </div>
            @if(isset($course))
                <div class="form-group">
                    <img src="{{ asset('storage/'.$course->image) }}" alt="" style="width: 100%">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id='image'>
            </div>
            @if(isset($course))
                <div class="form-group">
                    <img src="{{ asset('storage/'.$course->video) }}" alt="" style="width: 100%">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Video</label>
                <input type="file" class="form-control" name="video" id='video'>
            </div>
            <!-- <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" class="form-control" name="cost" id='cost' value="{{ isset($course) ? $course->cost: '' }}">
            </div> -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <select name="subject" id="subject" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @if(isset($course))
                            @if($subject->id === $course->subject_id)
                                selected
                            @endif
                        @endif
                    >
                    {{ $subject->name }}
                    </option>
                @endforeach
                </select>
            </div>

            <input type="hidden" class="form-control" value="{{ Auth::user()->id }}">
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                {{ isset($course) ? 'Update Course': 'Create Course' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr('#published_at', {
      enableTime: true
    })
  </script>
@endsection