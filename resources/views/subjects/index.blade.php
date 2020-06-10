@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    @auth
        @if(auth()->user()->isAdmin())  
            <a href="{{ route('subjects.create') }}" class="btn btn-success">Add Subject</a>
        @endif
    @endauth
</div>

<div class="card card-default">
    <div class="card-header"><h2 class="mt-2">Subjects</h2></div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Courses Count</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>
                        {{ $subject->name }}
                    </td>
                    <td>
                        {{ $subject->courses->count() }}
                    </td>
                    @auth
                        @if(auth()->user()->isAdmin())  
                            <td>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-info btn-sm">
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $subject->id }})">Delete</button>
                            </td>
                        @endif
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $subjects->links() }}

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
            form.action = '/subjects/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection