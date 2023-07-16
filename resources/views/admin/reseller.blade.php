@extends('layouts.admin')

@section('title', 'Reseller Management')
@section('page-title', 'Reseller Management')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Reseller</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (auth()->user()->role == 'superadmin')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Reseller</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.reseller.create') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="reseller-area">Daerah</label>
                                        <input type="text" class="form-control" id="reseller-area"
                                            placeholder="Enter reseller area" name="area">
                                    </div>
                                    <div class="form-group">
                                        <label for="reseller-phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="reseller-phone"
                                            placeholder="Enter reseller phone" name="phone">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Reseller</button>
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
                            <h3 class="card-title">Reseller List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Daerah</th>
                                        <th>Nomor Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resellers as $reseller)
                                        <tr>
                                            <td>{{ $reseller->area }}</td>
                                            <td>{{ $reseller->phone }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $reseller->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $reseller->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $reseller->id }}Label">Edit
                                                                        Category
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.reseller.update', $reseller->id) }}"
                                                                        method="POST" id="updateForm{{ $reseller->id }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="reseller-area">Daerah</label>
                                                                            <input type="text" class="form-control" id="reseller-area"
                                                                                placeholder="Enter reseller area" name="area" value="{{$reseller->area}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="reseller-phone">Nomor Telepon</label>
                                                                            <input type="text" class="form-control" id="reseller-phone"
                                                                                placeholder="Enter reseller phone" name="phone" value="{{$reseller->phone}}">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $reseller->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('dashboard.reseller.delete', $reseller->id) }}"
                                                        method="POST" id="deleteForm{{ $reseller->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $reseller->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $reseller->id }}">Delete</button>
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
