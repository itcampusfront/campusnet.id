@extends('template/front/main')

@section('title', 'Kategori')

@section('content')

<div class="row">
    <div class="container mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Kategori -->
        <section class="row mb-4" id="section-kategori">
            <div class="col-12 mb-2">
                <h4>Kategori</h4>
            </div>
            @if(count($kategori)>0)
                @foreach($kategori as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card shadow-sm rounded-2 border-0">
                        <a href="/kategori/{{ $data->slug_kategori }}">
                            <img class="card-img-top rounded-2 shadow" src="{{ $data->gambar_kategori != '' ? asset('assets/images/kategori/'.$data->gambar_kategori) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                        </a>
                        <div class="card-body">
                            <p class="card-title h6 mb-0">
                                <a class="text-dark" href="/kategori/{{ $data->slug_kategori }}" data-toggle="tooltip" title="{{ $data->nama_kategori }}">{{ $data->nama_kategori }}</a>
                            </p>
                        </div>
                        <div class="card-footer rounded-0 bg-transparent mx-3 px-0 text-muted">
                            <div class="row justify-content-between">
                                <small data-toggle="tooltip" title="{{ $data->count_kelas }} Kelas"><i class="fa fa-list mr-1"></i>{{ $data->count_kelas }}</small>
                                <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_kategori($data->id_kategori),1,'.','.') }}"><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_kategori($data->id_kategori),1,'.','.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-auto mx-auto">
                            {!! $kategori->links() !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                </div>
            @endif
        </section>
        <!-- /Kategori -->
    </div>
</div>

@endsection