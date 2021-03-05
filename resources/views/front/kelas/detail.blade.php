@extends('template/front/main')

@section('title', $kelas->nama_kelas)

@section('content')

<!-- Breadcrumb -->
<div class="row">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $kelas->nama_kelas }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Identitas Kelas -->
<section class="row" id="section-identity">
    <div class="container-fluid bg-primary">
        <div class="row">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-md-8 order-last order-md-first">
                        <p class="h3 my-3 text-white">{{ $kelas->nama_kelas }}</p>
                        <p class="text-light" id="identity-kelas">
                            <span><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_kelas($kelas->id_kelas),1,'.','.') }}</span>
                            <span class="badge badge-warning"><a class="text-dark" href="/kategori/{{ $kelas->slug_kategori }}">{{ $kelas->nama_kategori }}</a></span>
                            <span class="badge badge-success">Level: {{ $kelas->nama_level }}</span>
                        </p>
                        <p class="text-light">Pengajar: <a class="text-light pengajar" href="/pengajar/{{ $kelas->username }}">{{ $kelas->nama_user }}</a></p>
                    </div>
                    <div class="col-md-4 order-first order-md-last">
                        <img class="img-fluid gambar-kelas" src="{{ $kelas->gambar_kelas != '' ? asset('assets/images/kelas/'.$kelas->gambar_kelas) : asset('assets/images/default/kategori.jpg') }}" alt="Sampul Gambar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Identitas Kelas -->

<div class="row mt-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-last order-md-first">
                <p class="h4">Deskripsi</p>
                <div class="ql-snow mt-3 mb-4"><div class="ql-editor p-0">{!! html_entity_decode($kelas->deskripsi_kelas) !!}</div></div>
                <p class="h4">Materi</p>
                @if(count($topik)>0)
                <div id="accordion" class="mt-3 mb-4">
                    @foreach($topik as $key=>$data)
                    <div class="card">
                        <div class="card-header" id="heading-{{ $key }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link w-100 text-dark text-justify" data-toggle="collapse" data-target="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                {{ $data->nama_topik }}
                                </button>
                                <i class="fa fa-chevron-down"></i>
                            </h5>
                        </div>
                        <div id="collapse-{{ $key }}" class="collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $key }}" data-parent="#accordion">
                            <div class="card-body">
                                @if(count($data->konten)>0)
                                    <div class="list-group">
                                        @foreach($data->konten as $konten)
                                            <a class="list-group-item disabled d-flex justify-content-between align-items-center text-dark" href="#">
                                                <div class="mr-auto">
                                                    @if($konten->jenis_konten == 1)
                                                    <i class="fa fa-text-height mr-2"></i>
                                                    @elseif($konten->jenis_konten == 2)
                                                    <i class="fa fa-video-camera mr-2"></i>
                                                    @elseif($konten->jenis_konten == 3)
                                                    <i class="fa fa-file-o mr-2"></i>
                                                    @elseif($konten->jenis_konten == 4)
                                                    <i class="fa fa-question mr-2"></i>
                                                    @elseif($konten->jenis_konten == 5)
                                                    <i class="fa fa-tasks mr-2"></i>
                                                    @endif
                                                    {{ $konten->konten['nama'] }}
                                                </div>
                                                <div class="">
                                                    @if($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'youtube')
                                                        <span class=""><i class="fa fa-clock-o mr-1"></i>{{ generate_video_time($konten->konten['durasi']) }}</span>
                                                    @elseif($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'file')
                                                        <span class=""><i class="fa fa-clock-o mr-1"></i>{{ generate_video_time(get_video_time($konten->konten['video'])) }}</span>
                                                    @endif
                                                    <i class="fa fa-lock ml-2"></i>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger text-center mb-0">Tidak ada konten.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p>Tidak ada materi.</p>
                @endif
                <p class="h4">Ulasan</p>
                <div class="row align-items-center mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card">
                            <div class="card-body text-center">
                                <p class="rating text-warning">{{ number_format(rating_penilaian_kelas($kelas->id_kelas),1,'.','.') }}</p>
                                <p class="rating-stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @for($i=5; $i>=1; $i--)
                        <div class="row align-items-center font-weight-bold">
                            <div class="col-auto"><i class="fa fa-star text-warning mr-2"></i>{{ $i }}</div>
                            <div class="col">
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ count_penilaian_kelas_by_rating($kelas->id_kelas)[$i] != 0 ? (count_penilaian_kelas_by_rating($kelas->id_kelas)[$i] / count_penilaian_kelas($kelas->id_kelas)) * 100 : 0 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-auto">{{ count_penilaian_kelas_by_rating($kelas->id_kelas)[$i] }}</div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab-rating" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-tab-rating-all" data-toggle="pill" href="#pills-rating-all" role="tab" aria-controls="pills-rating-all" aria-selected="true"><i class="fa fa-star mr-1"></i>Semua ({{ count_penilaian_kelas($kelas->id_kelas) }})</a>
                            </li>
                            @for($i=5; $i>=1; $i--)
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab-rating-{{ $i }}" data-toggle="pill" href="#pills-rating-5" role="tab" aria-controls="pills-rating-{{ $i }}" aria-selected="true"><i class="fa fa-star mr-1"></i>{{ $i }} ({{ count_penilaian_kelas_by_rating($kelas->id_kelas)[$i] }})</a>
                            </li>
                            @endfor
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-rating-all" role="tabpanel" aria-labelledby="pills-tab-rating-all">Tidak ada ulasan.</div>
                            @for($i=5; $i>=1; $i--)
                            <div class="tab-pane fade" id="pills-rating-{{ $i }}" role="tabpanel" aria-labelledby="pills-tab-rating-{{ $i }}">Tidak ada ulasan.</div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 order-first order-md-last">
<!--                 <div class="card mb-3">
                    <div class="card-body text-center">
                        <p class="harga-kelas">{{ $kelas->harga_kelas > 0 ? 'Rp '.number_format($kelas->harga_kelas,0,'.','.') : 'Gratis!' }}</p>
                        <p>Kuota Terbatas</p>
                        <a href="#" class="btn btn-block btn-primary font-weight-bold">Ikut Kelas Ini</a>
                    </div>
                </div> -->
                @if(Auth::check() && Auth::user()->role == role_pelajar())
                <div class="progress mb-3">
                    <div class="progress-bar {{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) < 100 ? 'bg-warning' : 'bg-success' }}" role="progressbar" style="width: {{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}%;" aria-valuenow="{{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}" aria-valuemin="0" aria-valuemax="100"></div>
                    <span class="progress-bar-label"><span id="task-percentage">{{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}</span>% dikerjakan</span>
                </div>
                @endif
                <button type="button" class="btn btn-block btn-primary font-weight-bold mb-3" onclick="event.preventDefault(); document.getElementById('form-register-kelas').submit();" {{ Auth::check() && Auth::user()->role == role_pelajar() && count_konten_by_kelas($kelas->id_kelas) > 0 ? '' : 'disabled' }}>Belajar Sekarang</button>
                <form id="form-register-kelas" class="d-none" method="post" action="/kelas/register">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                </form>
                <div class="card">
                    <div class="card-body text-center">
                        <p class="h4 mb-3">Tentang Pengajar</p>
                        <p><img class="rounded-circle" width="150" src="{{ $kelas->foto != '' ? asset('assets/images/user/'.$kelas->foto) : asset('assets/images/default/user.jpg') }}"></p>
                        <p class="h5"><a class="text-dark" href="/pengajar/{{ $kelas->username }}">{{ $kelas->nama_user }}</a></p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <small data-toggle="tooltip" title="{{ count_kelas_by_pengajar($kelas->pengajar_kelas) }} Kelas"><i class="fa fa-list mr-1"></i>{{ count_kelas_by_pengajar($kelas->pengajar_kelas) }}</small>
                            <small data-toggle="tooltip" title="{{ count_ulasan_by_pengajar($kelas->pengajar_kelas) }} Ulasan"><i class="fa fa-comments mr-1"></i>{{ count_ulasan_by_pengajar($kelas->pengajar_kelas) }}</small>
                            <small data-toggle="tooltip" title="Rating {{ number_format(rating_penilaian_by_pengajar($kelas->pengajar_kelas),1,'.','.') }}"><i class="fa fa-star mr-1"></i>{{ number_format(rating_penilaian_by_pengajar($kelas->pengajar_kelas),1,'.','.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-extra')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style type="text/css">
    .ql-editor {white-space: normal;}
    #accordion .card-header .btn-link {font-weight: 500;}
    #accordion .card-header .fa {position: absolute; right: 1.25rem; line-height: 1.5; padding: .375rem; font-size: 1rem;}
    #accordion .list-group-item .fa {width: 14px;}
    #accordion .list-group-item:hover {background-color: #efefef; text-decoration: none;}
    .gambar-kelas {border-radius: .25rem;}
    .harga-kelas {font-size: 2rem; font-weight: 500; margin-bottom: .5rem;}
    .pengajar-details .fa {width: 18px;}
    .rating {font-size: 2rem; font-weight: 500; margin-bottom: .5rem;}
    .rating-stars {margin-right: 1rem;}
    .rating-stars:last-child {margin-right: 0;}
    .rating-stars .fa {color: #ffc107;}
    .progress {height: 1.25rem; font-size: .8rem;}
    .progress-bar-label {position: absolute; width: calc(100% - 30px); height: 1.25rem; line-height: 1.25rem; text-align: center;}
</style>

@endsection