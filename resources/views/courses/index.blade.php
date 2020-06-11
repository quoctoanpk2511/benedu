@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    @auth
        @if(!auth()->user()->isStudent())  
            <a href="{{ route('courses.create') }}" class="btn btn-success">Add Course</a>
        @endif
    @endauth
</div>

<div class="card card-default">
    <div class="card-header"><h2 class="mt-2">Courses</h2></div>

    <div class="card-body">
    <table class="table">
        <thead>
            <th>Image</th>
            <th>Title</th>
            <th>Subject</th>
            <th>Created By</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
        <!-- show all courses for admin -->
        @if(auth()->user()->isAdmin())
            @foreach($courses as $course)
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$course->image) }}" width="120px" alt="">
                </td>
                <td>
                    {{ $course->title }}
                </td>
                <td>
                    <a href="{{ route('subjects.edit', $course->subject->id) }}">
                        {{ $course->subject->name }}
                    </a>
                </td>
                <td>
                    {{ \App\User::where(['id' => $course->teacher_id])->first()->name }}
                </td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-success btn-sm">Enter</a>
                </td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info btn-sm">Edit</a>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $course->id }})">Delete</button>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="showModel({{ $course->id }})">Add Lesson</button>
                </td>
                <div class="modal fade" id="{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('courses.add-lesson') }}" method="POST" id="{{$course->id}}">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Add Lesson</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" class="form-control" name="description" >
                                </div>
                                <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{ $course->id }}">
                                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-success">Add Lesson</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </tr>
            @endforeach
        <!-- show only teaching courses for teacher -->
        <!-- @elseif(auth()->user()->isTeacher())
            @foreach($courses as $course)
                @if(Auth::user()->id == $course->teacher_id)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$course->image) }}" width="120px" alt="">
                    </td>
                    <td>
                        {{ $course->title }}
                    </td>
                    <td>
                        <a href="{{ route('subjects.edit', $course->subject->id) }}">
                            {{ $course->subject->name }}
                        </a>
                    </td>
                    <td>
                        {{ \App\User::where(['id' => $course->teacher_id])->first()->name }}
                    </td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-success btn-sm">Enter</a>
                    </td>
                    <td>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $course->id }})">Delete</button>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="showModel({{ $course->id }})">Add Lesson</button>
                    </td>
                    <div class="modal fade" id="{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('courses.add-lesson') }}" method="POST" id="{{$course->id}}">
                                @csrf
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Add Lesson</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" class="form-control" name="description" >
                                    </div>
                                    <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{ $course->id }}">
                                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                    <button type="submit" class="btn btn-success">Add Lesson</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
                @endif
            @endforeach -->
        @else
            <!-- show courses for student  -->
            @foreach($courses as $course)
                @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $course->id) )
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$course->image) }}" width="120px" alt="">
                    </td>
                    <td>
                        {{ $course->title }}
                    </td>
                    <td>
                        <a href="{{ route('subjects.edit', $course->subject->id) }}">
                            {{ $course->subject->name }}
                        </a>
                    </td>
                    <!-- <td>
                        {{ \App\User::where(['id' => $course->teacher_id])->first()->name }}
                    </td> -->
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-success btn-sm">Enter</a>
                    </td>
                </tr>
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
    {{ $courses->links() }}

    <!-- modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deleteCourseForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-bold">
                    Are you sure you want to delete this course ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal delete -->

    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteCourseForm')
            form.action = '/courses/' + id
            $('#deleteModal').modal('show')
        }
        function showModel(id) {
            var id = '#' + id.toString();
            $(id).modal('show')
        }
    </script>
@endsection