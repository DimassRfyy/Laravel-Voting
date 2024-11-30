@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="row">

        @can('user-create')
            <div class="col-md-12">
                <a href="{{ route('app.user.create') }}" class="btn btn-primary mb-3">Add User</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>
                                        <td>

                                            @can('user-update')
                                                <a href="{{ route('app.user.edit', $user->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.user.show', $user->id) }}" class="btn btn-info">Show</a>

                                            @can('user-delete')
                                                <form action="{{ route('app.user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
