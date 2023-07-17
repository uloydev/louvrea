@extends('layouts.custom')

@section('content')
    <div class="container">
        <h2>Informasi Reseller</h2>
        <p>Untuk kamu yang diluar Jabodetabek, jangan sedih kamu bisa melakukan order produk Louvrea
            melalui reseller resmi kami
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Daerah</th>
                    <th>Nomor WhatsApp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resellers as $reseller)
                    <tr>
                        <td>{{$reseller->area}}</td>
                        <td><a href="https://wa.me/{{preg_replace('/^0/', '62', str_replace('-','', $reseller->phone))}}">{{$reseller->phone}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
