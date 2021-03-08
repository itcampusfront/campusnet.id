@extends('template/member/main')

@section('title', 'Dashboard')

@section('content')

    @if(Auth::user()->status == 1 && Auth::user()->email_verified == 1)
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
                                <h1>0</h1>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center">
                        <div class="card-header rounded-3 border-0 shadow" style="background-color: #0d3b66; color: #fff">
                            <p class="m-0">Website Kamu</p>
                        </div>
                            <div class="card-body">
                                <h1>{{ count($website) }}</h1>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center">
                        <div class="card-header rounded-3 border-0 shadow" style="background-color: #ffd100; color: #fff">
                            <p class="m-0">Menunggu Pembayaran</p>
                        </div>
                            <div class="card-body">
                                <h1>0</h1>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 text-center">
                        <div class="card-header rounded-3 border-0 shadow" style="background-color: #735d78; color: #fff">
                            <p class="m-0">Transaksi Berhasil</p>
                        </div>
                            <div class="card-body">
                                <h1>{{ count($website) }}</h1>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
            <h5>Website Kamu</h5>
            <div class="list-group list-group-flush">
                @if(count($website)>0)
                    @foreach($website as $data)
                        <a class="list-group-item" href="/member/website/detail/{{ $data->id_website }}"><i class="fas fa-globe-asia mr-3"></i>{{ $data->website_url }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @elseif(Auth::user()->status == 0 && Auth::user()->email_verified == 0)
    <div class="content">
        <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
            <div class="media">
                <img width="150" class="mr-4" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
                <div class="media-body">
                    <h5 class="">Verifikasi Email Kamu</h5>
                    <p>Kami harus memverifikasi email kamu terlebih dahulu. Kami sudah mengirimkan email ke <strong>{{ Auth::user()->email }}</strong> untuk memverifikasi email kamu. Silahkan klik link / tombol pada email tersebut untuk melanjutkan.</p>
                    <!-- <a href="/member/website/create" class="btn btn-theme-2 rounded-3 px-3">Order Sekarang</a> -->
                </div>
            </div>
        </div>
    </div>
    @endif
  
@endsection