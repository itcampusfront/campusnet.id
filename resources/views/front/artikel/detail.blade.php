@extends('template/front/main')

@section('title', $artikel->judul_artikel)

@section('content')
<section>
  <div class="container my-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-1">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/artikel">Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $artikel->judul_artikel }}</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-lg-2 order-2 order-lg-1">
        <div class="side-artikel sticky-top" style="top: 8em">
          <div class="bg-white rounded-circle mb-2 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px"><i class="fa fa-user" style="font-size: 1.7rem"></i></div>
          <div class="text-center mb-3">
            <p class="text-body font-weight-bold m-0">{{ $artikel->kontributor_artikel != 0 ? $kontributor ? $kontributor->kontributor : '' : $artikel->nama_user }}</p>
            <p class="m-0"><small><i class="fa fa-bookmark"></i> {{ $artikel->kontributor_artikel != 0 ? 'Kontributor' : 'Author' }}</small></p>
            <p class="m-0"><small> {{ $artikel->kategori }}</small></p>
            <p class="m-0"><small><i class="fa fa-clock-o"></i> {{ time_elapsed_string($artikel->artikel_at) }}</small></p>
          </div>
          <div class="tag-list py-3 mb-3" style="overflow: auto;">
            @if(count($tag)>0)
              @foreach($tag as $data)
                <span class="badge badge-primary">#{{ $data->tag }}</span>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-7 order-1 order-lg-2"> 
        <article class="mb-3">
          <h2 class="mb-3">{{ $artikel->judul_artikel }}</h2>
            <img src="{{ asset('assets/images/artikel/'.$artikel->gambar_artikel) }}" class="img-fluid rounded">
            <div class="ql-snow mt-2"><div class="ql-editor">{!! html_entity_decode($artikel->konten_artikel) !!}
            </div></div>
        </article>
      </div>
      <div class="col-lg-3 order-3">
        <div class="kategori mb-3">
          <div class="heading">
            <h5 class="m-0">Kategori</h5>
            <hr>
          </div>
          <div class="card p-0 bg-transparent border-0">
            <div class="card-body">
              <ul class="list-unstyled">
                @if(count($kategori)>0)
                  @foreach($kategori as $data)
                  <li class="mb-2"><a href="#">{{ $data->kategori }}</a></li>
                  @endforeach
                @endif
              </ul>
            </div>  
          </div>
        </div>
        <div class="last-post">
          <div class="heading">
            <h5 class="m-0">Artikel Lainnya</h5>
            <hr>
          </div>
          <div class="row">
            <div class="col-6 col-lg-12">
              @if(count($artikel_lainnya)>0)
                @foreach($artikel_lainnya as $data)
                <div class="card p-0 bg-transparent border-0">
                  <img src="{{ asset('assets/images/artikel/'.$data->gambar_artikel) }}" class="card-img-top rounded"> 
                  <div class="card-body">
                    <a href="/artikel/{{ $data->slug_artikel }}">  
                      <p>{{ $data->judul_artikel }}</p>
                    </a>
                  </div>  
                </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection