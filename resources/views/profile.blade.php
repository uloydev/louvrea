@extends('layouts.custom')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        <div class="row">
            <div class="col-md-4">
                <!-- User information -->
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <img src="{{ isset($user->avatar) ? asset('storage/'.$user->avatar) : asset('img/profile-default.svg') }}" class="rounded-circle mx-auto d-block my-4" alt="profile image" style="width: 10em;">
                            <div class="form-group">
                                <label for="avatar">Profile Picture</label>
                                <input type="file" class="form-control-file" id="avatar" name="avatar">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama anda" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone"
                                    placeholder="Masukkan nomor telepon anda" name="phone" value="{{$user->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="alamat"
                                    placeholder="Masukkan Alamat anda" name="address">{{$user->address}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary bg-warning">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- My Order -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Order</h5>
                        <p class="card-text">You can track the progress of your orders here.</p>
                        <a href="{{route('order.my-order')}}" class="btn btn-primary bg-warning">Track Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
