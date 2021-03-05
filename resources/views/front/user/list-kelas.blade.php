@extends('template/front/main')

@section('title', 'List Kelas')

@section('content')

<div class="row">
    <div class="container mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Kelas</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <section class="row">
            <div class="col-lg-3 col-md-4 mb-3">
                @include('front/user/_sidebar-profile')
            </div>
            <div class="col-lg-9 col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">List Kelas</div>
                    <div class="card-body">
                        <!-- Kelas -->
                        <section class="row" id="section-kelas">
                            @if(count($kelas)>0)
                                @foreach($kelas as $data)
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                                    <div class="card">
                                        <a href="/kelas/{{ $data->slug_kelas }}">
                                            <img class="card-img-top" src="{{ $data->gambar_kelas != '' ? asset('assets/images/kelas/'.$data->gambar_kelas) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                                        </a>
                                        <div class="card-badge">
                                            <span class="badge badge-warning"><a class="text-dark" href="/kategori/{{ $data->slug_kategori }}">{{ $data->nama_kategori }}</a></span>
                                            <span class="badge badge-success">Level: {{ $data->nama_level }}</span>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-title h6">
                                                <a class="text-dark" href="/kelas/{{ $data->slug_kelas }}" data-toggle="tooltip" title="{{ $data->nama_kelas }}">{{ $data->nama_kelas }}</a>
                                            </p>
                                            <p class="card-person mb-0">Oleh <a class="text-dark pengajar" href="/pengajar/{{ $data->username }}" data-toggle="tooltip" title="{{ $data->nama_user }}">{{ $data->nama_user }}</a></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <div class="row justify-content-between">
                                                <small data-toggle="tooltip" title="{{ count_penilaian_kelas($data->id_kelas) }} Ulasan"><i class="fa fa-comments mr-1"></i>{{ count_penilaian_kelas($data->id_kelas) }}</small>
                                                <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}"><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_kelas($data->id_kelas),1,'.','.') }}</small>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted text-center">
                                            <small data-toggle="tooltip" title="Dibuat pada {{ date('d/m/Y H:i:s', strtotime($data->kelas_at)) }}">Dibuat pada {{ date('d/m/Y', strtotime($data->kelas_at)) }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                                </div>
                            @endif
                        </section>
                        <!-- /Kelas -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('front/user/_modal-croppie')

@endsection

@section('js-extra')

@include('front/user/_js-croppie')

@endsection

@section('css-extra')

@include('front/user/_css-croppie')

@endsection