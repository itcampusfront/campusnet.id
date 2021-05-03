@extends('template/front/main')

@section('title', 'Artikel')

@section('content')
<section>
    <div class="container my-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb rounded-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
          </ol>
        </nav>
        <div class="content">
            <div class="row">
                @if(count($artikel)>0)
                    @foreach($artikel as $data)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-2">
                                <a href="/artikel/{{ $data->slug_artikel }}">
                                <img src="{{ asset('assets/images/artikel/'.$data->gambar_artikel) }}" alt="thumbnail" class="card-img-top rounded-1"></a>
                                <div class="card-body">
                                    <a href="/artikel/{{ $data->slug_artikel }}"><p class="m-0 font-weight-bold">{{ $data->judul_artikel }}</p></a>
                                    <p class="m-0 text-muted">{{ substr(strip_tags(html_entity_decode($data->konten_artikel)),0,100) }}...</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection