@extends('template/member/main')

@section('title', 'Dashboard')

@section('content')

    @if(Auth::user()->status == 1 && Auth::user()->email_verified == 1)
    <div class="content">
        @include('template/member/_order-now')
        <div class="detail mb-3">
            <div class="row">
                <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                    <div class="card border-0 shadow-sm rounded-3 text-center">
                        <div class="card-header rounded-3 border-0 shadow" style="background-color: #0d3b66; color: #fff">
                            <p class="m-0">Website Kamu</p>
                        </div>
                        <div class="card-body">
                            <h1>{{ count($website) }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                    <div class="card border-0 shadow-sm rounded-3 text-center">
                        <div class="card-header rounded-3 border-0 shadow" style="background-color: #735d78; color: #fff">
                            <p class="m-0">Transaksi</p>
                        </div>
                        <div class="card-body">
                            <h1>{{ count($website) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kelola-website">
            <div class="heading d-flex justify-content-between align-items-center mb-3 p-3 rounded-2" style="background-color: var(--color-1-1)">
              <div class="text-center text-md-left w-100" style="color: var(--color-1)">
                <h4>Kelola Website</h4>
                <p class="m-0 text-muted">Website dapat dikelola disini</p>
              </div>
              <img width="100" class="img-fluid d-none d-md-block" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-theme-1 rounded-3 shadow">
                    <p class="font-weight-bold m-0">Website</p>
                    <p class="m-0">Total website {{ count($website) }}</p>
                </div>            
                <div class="card-body">
                    <div class="row">
                        @if(count($website)>0)
                            @foreach($website as $data)
                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                <div class="card border">
                                  <div class="card-header bg-transparent mx-3 px-0 ">
                                    <a href="/member/website/detail/{{ $data->id_website }}">{{ $data->website_url }}</a>
                                  </div>
                                  <div class="card-body text-center">
                                    @if($data->website_status == 1)
                                    <a href="{{ $data->website_url }}" class="btn btn-theme-1 rounded-3 px-3" target="_blank">Lihat</a>
                                    @else
                                    <a class="btn btn-secondary rounded-3 px-3">Belum Aktif</a>
                                    @endif
                                    <a href="/member/website/detail/{{ $data->id_website }}" class="btn btn-theme-2 rounded-3 px-3">Kelola</a>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center">
                                <div class="alert alert-danger rounded-2">Anda Belum Mempunyai Website</div>
                            </div>
                        @endif
                    </div>
                </div>
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