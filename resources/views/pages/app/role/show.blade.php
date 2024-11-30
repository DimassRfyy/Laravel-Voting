@extends('layouts.app')

@section('title', $role->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('app.role.index') }}" class="btn btn-danger mb-3">Back</a>
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $role->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $role->name }}</td>
                            </tr>

                            <tr>
                                <th>Permission</th>
                                <td>
                                    <ul>
                                        @foreach ($role->permissions as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
