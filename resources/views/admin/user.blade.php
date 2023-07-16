@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
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
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $user->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $user->id }}Label">Edit User
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.user.update', $user->id) }}"
                                                                        method="POST" id="updateForm{{ $user->id }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="userName">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userName" placeholder="Enter name"
                                                                                name="name" value="{{ $user->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="userEmail">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="userEmail" placeholder="Enter email"
                                                                                name="email" value="{{ $user->email }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="userPassword">Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="userPassword"
                                                                                placeholder="Enter password"
                                                                                name="password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="userPasswordVerify">Confirm
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="userPasswordVerify"
                                                                                placeholder="Enter password confirmation"
                                                                                name="password_confirmation">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $user->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('dashboard.user.delete', $user->id) }}"
                                                        method="POST" id="deleteForm{{ $user->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $user->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $user->id }}">Delete</button>
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
