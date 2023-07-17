@extends('layouts.admin')

@section('title', 'Order Management')
@section('page-title', 'Order Management')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Order</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order date</th>
                                        <th>Customer</th>
                                        <th>Ship to</th>
                                        <th>Products</th>
                                        <th>Total</th>
                                        <th>Status Order</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d F Y H:i:s') }}</td>
                                            <td>{{ $order->customer->email }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                                @foreach ($order->orderItems as $item)
                                                    <ul>
                                                        <li>
                                                            <div>{{ $item->product->name }}</div>
                                                            <div>qty: {{ $item->quantity }}</div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </td>
                                            <td>{{$order->grand_total}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>
                                                @if (auth()->user()->role == 'superadmin')
                                                    <div class="modal fade" id="updateModal{{ $order->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="updateModal{{ $order->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateModal{{ $order->id }}Label">Edit Order
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('dashboard.order.update', $order->id) }}"
                                                                        method="POST" id="updateForm{{ $order->id }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="orderStatus">Status</label>
                                                                            <select class="form-control"
                                                                                id="orderStatus"
                                                                                name="status">
                                                                                @foreach ($orderStatus as $status)
                                                                                    <option value="{{$status}}" @if ($status == $order->status) selected @endif>{{$status}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="orderResi">Resi</label>
                                                                            <input type="text" class="form-control"
                                                                                id="orderResi" placeholder="Enter Resi Number"
                                                                                name="awb_number" value="{{ $order->awb_number }}">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        form="updateForm{{ $order->id }}">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <form action="{{ route('dashboard.order.delete', $order->id) }}"
                                                        method="POST" id="deleteForm{{ $order->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form> --}}
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#updateModal{{ $order->id }}">Edit</button>
                                                    {{-- <button class="btn btn-danger btn-sm"
                                                        form="deleteForm{{ $order->id }}">Delete</button> --}}
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
