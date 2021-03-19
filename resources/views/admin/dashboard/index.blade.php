@extends('template/admin/main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
  <!-- <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
      <div class="media">
          <img width="150" class="mr-4" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
          <div class="media-body">
              <h5 class="m-0">Selamat datang {{ Auth::user()->nama_user }}</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli<br>sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
              <button class="btn btn-theme-2 rounded-3 px-3">Order Sekarang</button>
          </div>
      </div>
  </div> -->
  <div class="detail mb-3">
      <div class="row">
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3 text-center">
                  <div class="card-header rounded-3 border-0 shadow" style="background-color: #f95738; color: #fff">
                      <p class="m-0">Pengguna Baru</p>
                  </div>
                    <div class="card-body">
                        <h1>{{ $count_user }}</h1>
                    </div>
              </div>
          </div>
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3 text-center">
                  <div class="card-header rounded-3 border-0 shadow" style="background-color: #0d3b66; color: #fff">
                      <p class="m-0">Website Baru</p>
                  </div>
                    <div class="card-body">
                        <h1>{{ $count_website }}</h1>
                    </div>
              </div>
          </div>
          <!-- <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3 text-center">
                  <div class="card-header rounded-3 border-0 shadow" style="background-color: #ffd100; color: #fff">
                      <p class="m-0">Pembayaran</p>
                  </div>
                    <div class="card-body">
                        <h1>0</h1>
                    </div>
              </div>
          </div> -->
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3 text-center">
                  <div class="card-header rounded-3 border-0 shadow" style="background-color: #735d78; color: #fff">
                      <p class="m-0">Transaksi</p>
                  </div>
                    <div class="card-body">
                        <h1>{{ $count_website }}</h1>
                    </div>
              </div>
          </div>
      </div>
  </div>
  <section>
    <div class="heading d-flex justify-content-between align-items-center mb-3 bg-theme-1 p-3 rounded-2">
      <div class="text-center text-md-left w-100">
        <h4>Kelola Website</h4>
        <p class="m-0">Website dapat dikelola disini</p>
      </div>
      <img width="100" class="img-fluid d-none d-md-block" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
    </div>
    <div class="row">
      @if(count($website)>0)
          @foreach($website as $data)
          <div class="col-12 col-sm-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm rounded-2">
              <div class="card-header bg-transparent mx-3 px-0 ">
                <a href="/admin/website/detail/{{ $data->id_website }}">{{ $data->website_url }}</a>
              </div>
              <div class="card-body text-center">
                @if($data->website_status == 1)
                <a href="{{ $data->website_url }}" class="btn btn-theme-1 rounded-3 px-3" target="_blank">Lihat</a>
                @else
                <a class="btn btn-secondary rounded-3 px-3">Belum Aktif</a>
                @endif
                <a href="/admin/website/detail/{{ $data->id_website }}" class="btn btn-theme-2 rounded-3 px-3">Kelola</a>
              </div>
            </div>
          </div>
          @endforeach
      @endif
    </div>
  </section>
</div>
  
@endsection