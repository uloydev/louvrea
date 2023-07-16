@extends('layouts.admin')

@section('title', 'Admin Management')
@section('page-title', 'Admin Management')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Admin</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (auth()->user()->role == 'superadmin')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Admin</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.admin.create') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="adminName">Name</label>
                                        <input type="text" class="form-control" id="adminName" placeholder="Enter name"
                                            name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminEmail">Email</label>
                                        <input type="email" class="form-control" id="adminEmail" placeholder="Enter email"
                                            name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminPassword">Password</label>
                                        <input type="password" class="form-control" id="adminPassword"
                                            placeholder="Enter password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="adminPasswordVerify">Confirm Password</label>
                                        <input type="password" class="form-control" id="adminPasswordVerify"
                                            placeholder="Enter password confirmation" name="password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Admin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $admin->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $admin->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $admin->id }}Label">Edit Admin
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.admin.update', $admin->id) }}"
                                                                        method="POST" id="updateForm{{ $admin->id }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="adminName">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="adminName" placeholder="Enter name"
                                                                                name="name" value="{{ $admin->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="adminEmail">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="adminEmail" placeholder="Enter email"
                                                                                name="email" value="{{ $admin->email }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="adminPassword">Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="adminPassword"
                                                                                placeholder="Enter password"
                                                                                name="password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="adminPasswordVerify">Confirm
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="adminPasswordVerify"
                                                                                placeholder="Enter password confirmation"
                                                                                name="password_confirmation">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $admin->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('dashboard.admin.delete', $admin->id) }}"
                                                        method="POST" id="deleteForm{{ $admin->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $admin->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $admin->id }}">Delete</button>
                                                @endif
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
    </section>
@endsection
