@extends('layouts.admin')

@section('title', 'Product Categories')
@section('page-title', 'Product Categories')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Product Categories</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (auth()->user()->role == 'superadmin')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Category</h3>
                            </div>
                            <div class="card-body">
                                <form id="add-category-form" action="{{ route('dashboard.product-category.create') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category-name">Category Name</label>
                                        <input type="text" class="form-control" id="category-name"
                                            placeholder="Enter category name" name="name">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Category</button>
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
                            <h3 class="card-title">Category List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="category-table-body">
                                    @foreach ($categories as $cat)
                                        <tr>
                                            <td>{{ $cat->name }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $cat->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $cat->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $cat->id }}Label">Edit
                                                                        Category
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.product-category.update', $cat->id) }}"
                                                                        method="POST" id="updateForm{{ $cat->id }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="category-name">Category Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="category-name"
                                                                                placeholder="Enter category name"
                                                                                name="name" value="{{ $cat->name }}">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $cat->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form
                                                        action="{{ route('dashboard.product-category.delete', $cat->id) }}"
                                                        method="POST" id="deleteForm{{ $cat->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $cat->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $cat->id }}">Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Category data will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
