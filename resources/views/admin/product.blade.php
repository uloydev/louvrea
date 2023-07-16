@extends('layouts.admin')

@section('title', 'Product Management')
@section('page-title', 'Product Management')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Product Management</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (auth()->user()->role == 'superadmin')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Product</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.product.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control" id="productName"
                                            placeholder="Enter product name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription">Product Description</label>
                                        <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"
                                            name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Price</label>
                                        <input type="number" class="form-control" id="productPrice"
                                            placeholder="Enter product price" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="productImage">Image</label>
                                        <input type="file" class="form-control-file" id="productImage" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="productSize">Size</label>
                                        <input type="text" class="form-control" id="productSize"
                                            placeholder="Enter product size" name="size">
                                    </div>
                                    <div class="form-group">
                                        <label for="productStock">Stock</label>
                                        <input type="number" class="form-control" id="productStock"
                                            placeholder="Enter product stock" name="stock">
                                    </div>
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select class="form-control" id="productCategory" name="category">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Product</button>
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
                            <h3 class="card-title">Product List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Size</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="category-table-body">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</td>
                                            <td><img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" class="product-image"></td>
                                            <td>{{ $product->size }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $product->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $product->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $product->id }}Label">Edit
                                                                        Category
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.product.update', $product->id) }}"
                                                                        method="POST" id="updateForm{{ $product->id }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="productName">Product Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="productName"
                                                                                placeholder="Enter product name"
                                                                                name="name"
                                                                                value="{{ $product->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productDescription">Product
                                                                                Description</label>
                                                                            <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"
                                                                                name="description">{{ $product->description }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productPrice">Price</label>
                                                                            <input type="number" class="form-control"
                                                                                id="productPrice"
                                                                                placeholder="Enter product price"
                                                                                name="price"
                                                                                value="{{ $product->price }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productImage">Image</label>
                                                                            <input type="file"
                                                                                class="form-control-file"
                                                                                id="productImage" name="image">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productSize">Size</label>
                                                                            <input type="text" class="form-control"
                                                                                id="productSize"
                                                                                placeholder="Enter product size"
                                                                                name="size"
                                                                                value="{{ $product->size }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productStock">Stock</label>
                                                                            <input type="number" class="form-control"
                                                                                id="productStock"
                                                                                placeholder="Enter product stock"
                                                                                name="stock"value="{{ $product->stock }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="productCategory">Category</label>
                                                                            <select class="form-control"
                                                                                id="productCategory" name="category">
                                                                                @foreach ($categories as $cat)
                                                                                    <option value="{{ $cat->id }}"
                                                                                        @if ($product->product_category_id == $cat->id) selected @endif>
                                                                                        {{ $cat->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $product->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('dashboard.product.delete', $product->id) }}"
                                                        method="POST" id="deleteForm{{ $product->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $product->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $product->id }}">Delete</button>
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
