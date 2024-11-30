@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <div class="row">

        @can('role-create')
            <div class="col-md-12">
                <a href="{{ route('app.role.create') }}" class="btn btn-primary mb-3">Add Role</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->permissions->count() }} Permission</td>
                                        <td>

                                            @can('role-update')
                                                <a href="{{ route('app.role.edit', $role->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.role.show', $role->id) }}" class="btn btn-info">Show</a>

                                            @can('role-delete')
                                                <form action="{{ route('app.role.destroy', $role->id) }}" method="POST"
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
