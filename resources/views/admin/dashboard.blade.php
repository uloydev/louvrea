@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Products</h3>
                        </div>
                        <div class="card-body">
                            <h4>{{ $productCount }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Orders</h3>
                        </div>
                        <div class="card-body">
                            <h4>{{ $orderCount }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Customers</h3>
                        </div>
                        <div class="card-body">
                            <h4>{{ $customerCount }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Income</h3>
                        </div>
                        <div class="card-body">
                            <h4>{{ $income }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Sales</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="monthlySalesChart" height="180" width="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@push('script')
    <script>
        $(function() {
            // Monthly Sales Chart
            var ctx = document.getElementById('monthlySalesChart').getContext('2d');
            var monthlySalesChart = new Chart(ctx, {
                type: 'line',
                data: {!! $salesData !!},
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
