@extends('template/front/main')

@section('title', 'Pengajar')

@section('content')

<div class="row">
    <div class="container mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengajar</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Pengajar -->
        <section class="row mb-4" id="section-pengajar">
            <div class="col-12 mb-2">
                <h4>Pengajar</h4>
            </div>
            @if(count($pengajar)>0)
                @foreach($pengajar as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <p><img class="rounded-circle" width="150" src="{{ $data->foto != '' ? asset('assets/images/user/'.$data->foto) : asset('assets/images/default/user.jpg') }}"></p>
                            <p class="card-title h6 mb-0">
                                <a class="text-dark" href="/pengajar/{{ $data->username }}" data-toggle="tooltip" title="{{ $data->nama_user }}">{{ $data->nama_user }}</a>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <small data-toggle="tooltip" title="{{ count_kelas_by_pengajar($data->id_user) }} Kelas"><i class="fa fa-list mr-1"></i>{{ count_kelas_by_pengajar($data->id_user) }}</small>
                                <small data-toggle="tooltip" title="{{ count_ulasan_by_pengajar($data->id_user) }} Ulasan"><i class="fa fa-comments mr-1"></i>{{ count_ulasan_by_pengajar($data->id_user) }}</small>
                                <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_by_pengajar($data->id_user),1,'.','.') }}"><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_by_pengajar($data->id_user),1,'.','.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-auto mx-auto">
                            {!! $pengajar->links() !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-danger text-center">Data tidak tersedia.</div>
                </div>
            @endif
        </section>
        <!-- /Pengajar -->
    </div>
</div>

@endsection