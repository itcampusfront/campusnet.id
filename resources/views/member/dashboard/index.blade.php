@extends('template/member/main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
    @include('template/member/_order-now')
    <div class="detail mb-4">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 text-center">
                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #f95738; color: #fff">
                        <p class="m-0">Pengguna Baru</p>
                    </div>
                        <div class="card-body">
                            <h1>2</h1>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 text-center">
                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #0d3b66; color: #fff">
                        <p class="m-0">Website Baru</p>
                    </div>
                        <div class="card-body">
                            <h1>2</h1>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 text-center">
                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #ffd100; color: #fff">
                        <p class="m-0">Menunggu Pembayaran</p>
                    </div>
                        <div class="card-body">
                            <h1>2</h1>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 text-center">
                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #735d78; color: #fff">
                        <p class="m-0">Transaksi Berhasil</p>
                    </div>
                        <div class="card-body">
                            <h1>2</h1>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Website Kamu</h5>
        <div class="list-group list-group-flush">
            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
        </div>
    </div>
</div>
  
@endsection