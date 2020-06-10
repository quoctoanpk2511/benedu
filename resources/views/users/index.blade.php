@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header"><h2 class="mt-2">User</h2></div>

    <div class="card-body">
        @if($users->count() > 0)
        <table class="table">
            <thead>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                    <td>
                        {{ $user->role }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        @if($user->isAdmin())
                        
                        <!-- @elseif ($user->isTeacher())
                            <form action="{{ route('users.make-admin', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Admin</button>
                            </form>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})">Delete</button> -->
                        @else
                            <form action="{{ route('users.make-admin', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Admin</button>
                            </form>
                            <!-- <form action="{{ route('users.make-teacher', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Teacher</button>
                            </form> -->
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})">Delete</button>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteUserForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">
                        Are you sure you want to delete <b class="text-danger">{{ $user->name }}</b> ?
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

        @else
        <h3 class="text-center">No Users Yet</h3>
        @endif
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteUserForm')
            form.action = '/users/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection