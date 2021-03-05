@extends('template/front/main')

@section('title', 'Beranda')

@section('content')
<section class="section-carousel pt-4">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner shadow-sm rounded-3">
            <div class="carousel-item active">
              <img src="{{ asset('assets/images/banner/3.jpg') }}" class="d-block w-100 rounded-3 shadow" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/images/banner/2.jpg') }}" class="d-block w-100 rounded-3 shadow" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/images/banner/1.jpg') }}" class="d-block w-100 rounded-3 shadow" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev d-none d-lg-flex" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <div class="carousel-control-bg prev bg-white rounded-circle shadow-sm">
                <span aria-hidden="true"><i class="fas fa-chevron-left color-theme-1 h4 m-0"></i></span>
                <span class="sr-only">Prev</span>
            </div>
          </a>
          <a class="carousel-control-next d-none d-lg-flex" href="#carouselExampleIndicators" role="button" data-slide="next">
            <div class="carousel-control-bg next bg-white rounded-circle shadow-sm">
                <span aria-hidden="true"><i class="fas fa-chevron-right color-theme-1 h4 m-0"></i></span>
                <span class="sr-only">Next</span>
            </div>
          </a>
        </div>
    </div>
</section>
<section class="section-kategory mt-5">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-2">
            <div class="card-header rounded-2 border-0 bg-theme-1-opacity shadow">
                <p class="m-0">Kategori</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/teknologi.svg') }}">
                            <p>Teknologi</p>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/sains.svg') }}">
                            <p>Sains</p>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/kesehatan.svg') }}">
                            <p>Kesehatan</p>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/marketing.svg') }}">
                            <p>Marketing</p>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/otomotif.svg') }}">
                            <p>Otomotif</p>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 text-center mb-2 mb-lg-0">
                        <a href="#" class="text-body text-decoration-none">
                            <img width="80" src="{{ asset('assets/images/kategori/desain.svg') }}">
                            <p>Desain</p>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-transparent text-center pb-0"><a href="/kategori" class="btn btn-theme-1 rounded-3 px-3">Semua Kategori</a></div>
            </div>
        </div>
    </div>
</section>
<section class="section-kelas mt-5" id="section-kelas">
    <div class="container">
        <!-- Kategori -->
        <!-- <div class="row mb-4 d-none">
            <div class="col-12 mb-2">
                <div class="row justify-content-between align-items-center">
                    <h4>Kategori</h4>
                    <a class="btn btn-sm btn-primary" href="/kategori">Lihat Semua</a>
                </div>
            </div>
            @if(count($kategori)>0)
                @foreach($kategori as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card shadow">
                        <a href="/kategori/{{ $data->slug_kategori }}">
                            <img class="card-img-top" src="{{ $data->gambar_kategori != '' ? asset('assets/images/kategori/'.$data->gambar_kategori) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                        </a>
                        <div class="card-body">
                            <p class="card-title h6 mb-0">
                                <a class="text-dark" href="/kategori/{{ $data->slug_kategori }}" data-toggle="tooltip" title="{{ $data->nama_kategori }}">{{ $data->nama_kategori }}</a>
                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="row justify-content-between">
                                <small data-toggle="tooltip" title="{{ $data->count_kelas }} Kelas"><i class="fa fa-list mr-1"></i>{{ $data->count_kelas }}</small>
                                <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_kategori($data->id_kategori),1,'.','.') }}"><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_kategori($data->id_kategori),1,'.','.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                </div>
            @endif
        </div> -->
        <!-- /Kategori -->
        <div id="section-kelas">
            <div class="heading">
                <h4>Kelas</h4>
                <p>Kelas yang mugkin anda sukai</p>
            </div>
            <div class="row"> 
                @if(count($kelas)>0)
                    @foreach($kelas as $data)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card shadow-sm rounded-2 border-0">
                            <a href="/kelas/{{ $data->slug_kelas }}">
                                <img class="card-img-top rounded-2 shadow" src="{{ $data->gambar_kelas != '' ? asset('assets/images/kelas/'.$data->gambar_kelas) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                            </a>
                            <div class="card-badge">
                                <span class="badge bg-theme-1"><a class="text-white text-decoration-none" href="/kategori/{{ $data->slug_kategori }}">{{ $data->nama_kategori }}</a></span>
                                <span class="badge badge-warning color-theme-2">Level: {{ $data->nama_level }}</span>
                            </div>
                            <div class="card-body">
                                <p class="card-title h6">
                                    <a class="text-dark text-decoration-none" href="/kelas/{{ $data->slug_kelas }}" data-toggle="tooltip" title="{{ $data->nama_kelas }}">{{ $data->nama_kelas }}</a>
                                </p>
                                <p class="card-person mb-0">Oleh <a class="text-dark pengajar text-decoration-none" href="/pengajar/{{ $data->username }}" data-toggle="tooltip" title="{{ $data->nama_user }}">{{ $data->nama_user }}</a></p>
                            </div>
                            <div class="card-footer mx-3 px-0 py-3 bg-transparent text-muted">
                                <div class="d-flex justify-content-between">
                                    <small data-toggle="tooltip" title="{{ count_penilaian_kelas($data->id_kelas) }} Ulasan"><i class="fa fa-comments mr-1 color-theme-2"></i>{{ count_penilaian_kelas($data->id_kelas) }}</small>
                                    <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}"><i class="fa fa-star mr-1 text-warning"></i>{{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                    </div>
                @endif
            </div>
            <div class="text-center mt-4">
                <a class="btn btn-theme-1 rounded-3 px-3 shadow-sm" href="/kelas">Tampilkan Lainya</a>
            </div>
        </div>
    </div>
</section>
<section class="section-artikel my-5" id="section-kelas">
    <div class="container">
        <div class="heading">
            <h4>Artikel</h4>
            <p>Artikel yang mugkin anda sukai</p>
        </div>
        <div class="row"> 
            @if(count($kelas)>0)
                @foreach($kelas as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card shadow-sm rounded-2 border-0">
                        <a href="/kelas/{{ $data->slug_kelas }}">
                            <img class="card-img-top rounded-2 shadow" src="{{ $data->gambar_kelas != '' ? asset('assets/images/kelas/'.$data->gambar_kelas) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                        </a>
                        <div class="card-badge">
                            <span class="badge bg-theme-1"><a class="text-white text-decoration-none" href="/kategori/{{ $data->slug_kategori }}">{{ $data->nama_kategori }}</a></span>
                            <span class="badge badge-warning color-theme-2">Level: {{ $data->nama_level }}</span>
                        </div>
                        <div class="card-body">
                            <p class="card-title h6">
                                <a class="text-dark text-decoration-none" href="/kelas/{{ $data->slug_kelas }}" data-toggle="tooltip" title="{{ $data->nama_kelas }}">{{ $data->nama_kelas }}</a>
                            </p>
                            <p class="card-person mb-0">Oleh <a class="text-dark pengajar text-decoration-none" href="/pengajar/{{ $data->username }}" data-toggle="tooltip" title="{{ $data->nama_user }}">{{ $data->nama_user }}</a></p>
                        </div>
                        <div class="card-footer mx-3 px-0 py-3 bg-transparent text-muted">
                            <div class="d-flex justify-content-between">
                                <small data-toggle="tooltip" title="{{ count_penilaian_kelas($data->id_kelas) }} Ulasan"><i class="fa fa-comments mr-1 color-theme-2"></i>{{ count_penilaian_kelas($data->id_kelas) }}</small>
                                <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}"><i class="fa fa-star mr-1 text-warning"></i>{{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                </div>
            @endif
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-theme-1 rounded-3 px-3 shadow-sm" href="/kelas">Tampilkan Lainya</a>
        </div>
    </div>
</section>
@endsection