@extends('template/admin/main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
  <div class="detail mb-3">
      <div class="row">
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3" style="background-color: #f95738; color: var(--white)">
                <div class="card-body d-flex align-items-center">
                  <h1 class="mr-3">{{ $count_user }}</h1>
                  <p class="m-0"><span class="font-weight-bold">Pengguna</span><br><span class="small">Baru</span></p>
                </div>
              </div>
          </div>
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3" style="background-color: #0d3b66; color: var(--white)">
                <div class="card-body d-flex align-items-center">
                  <h1 class="mr-3">{{ $count_website }}</h1>
                  <p class="m-0"><span class="font-weight-bold">Website</span><br><span class="small">Baru</span></p>
                </div>
              </div>
          </div>
          <div class="col-12 col-md-4 mb-3 mb-lg-0">
              <div class="card border-0 shadow-sm rounded-3" style="background-color: #735d78; color: var(--white)">
                <div class="card-body d-flex align-items-center">
                  <h1 class="mr-3">{{ $count_website }}</h1>
                  <p class="m-0"><span class="font-weight-bold">Transaksi</span><br><span class="small">Total</span></p>
                </div>
              </div>
          </div>
      </div>
  </div>
  <section>
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
        <p class="m-0">Total website {{ $count_website }}</p>
      </div>
      <div class="card-body">
        <div class="row">
          @if(count($website)>0)
              @foreach($website as $data)
              <div class="col-12 col-sm-6 col-lg-4 mb-3">
                <div class="card border">
                  <div class="card-header bg-transparent mx-3 px-0 ">
                    <a href="/admin/website/detail/{{ $data->id_website }}">{{ $data->website_url }}</a>
                  </div>
                  <div class="card-body text-center">
                    @if($data->website_status == 1)
                    <a href="{{ $data->website_url }}" class="btn btn-theme-1 rounded-3 px-3" target="_blank">Lihat</a>
                    @else
                    <a class="btn btn-secondary rounded-3 px-3">Belum Aktif</a>
                    @endif
                    <a href="/admin/website/detail/{{ $data->id_website }}" class="btn btn-light rounded-3 px-3">Kelola</a>
                  </div>
                </div>
              </div>
              @endforeach
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
  
@endsection