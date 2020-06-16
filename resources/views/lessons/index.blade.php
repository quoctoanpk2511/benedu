@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header"><h2 class="mt-2">Lessons</h2></div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Couse</th>
                <!-- <th>Description</th> -->
                <th>Progress</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
            @auth
            @if(!auth()->user()->isStudent())
                @foreach($lessons as $lesson)
                <tr>
                    <td>
                        {{ $lesson->title }}
                    </td>
                    <!-- <td>
                        {{ $lesson->description }}
                    </td> -->
                    <td>
                        {{ $lesson->course->title }}
                    </td>
                    @auth
                        @if(!auth()->user()->isStudent())  
                            <td>
                                <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-info btn-sm">
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $lesson->id }})">Delete</button>
                            </td>
                        @endif
                    @endauth
                </tr>
                @endforeach
            @else
                @foreach($lessons as $lesson)
                @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $lesson->course->id) )
                <tr>
                    <td>
                        <!-- {{ $lesson->title }} -->
                        {{ $lesson->course->title }}
                    </td>
                    <!-- <td>
                        {{ $lesson->course->description }}
                    </td> -->
                    <td>
                        <p>4/6</p>
                    </td>
                </tr>
                @endif
                @endforeach
            @endif
            @endauth
            </tbody>
        </table>
        {{ $lessons->links() }}

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteSubjectForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">
                        Are you sure you want to delete this subject ?
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
  </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteSubjectForm')
            form.action = '/lessons/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection