@extends('template/admin/main')

@section('title', 'Edit Artikel')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Artikel</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Edit Artikel</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.artikel.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $artikel->id_artikel }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Judul Artikel <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" name="judul_artikel" class="form-control {{ $errors->has('judul_artikel') ? 'border-danger' : '' }}" value="{{ $artikel->judul_artikel }}">
                        @if($errors->has('judul_artikel'))
                        <div class="small text-danger">{{ ucfirst($errors->first('judul_artikel')) }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select name="kategori" class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}" >
                            <option value="" disabled selected>--Pilih--</option>
                            @foreach($kategori as $data)
                            <option value="{{ $data->id_ka }}" {{ $artikel->kategori_artikel === $data->id_ka ? 'selected' : '' }}>{{ $data->kategori }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('kategori'))
                        <div class="small text-danger mt-1">{{ ucfirst($errors->first('kategori')) }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Gambar</label>
                    <div class="col-md-10">
                        <input type="file" id="file" class="d-none" accept="image/*">
                        <a class="btn btn-sm btn-secondary btn-image" href="#"><i class="fa fa-image mr-2"></i>Pilih Gambar...</a>
                        <br>
                        <img id="img-file" class="mt-2 img-thumbnail {{ $artikel->gambar_artikel != '' ? '' : 'd-none' }}" src="{{ $artikel->gambar_artikel != '' ? asset('assets/images/artikel/'.$artikel->gambar_artikel) : '' }}" style="max-height: 150px">
                        <input type="hidden" name="gambar">
                        <input type="hidden" name="gambar_url">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Tag</label>
                    <div class="col-md-10">
                        <input type="text" name="tag" data-role="tagsinput" class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" value="{{ generate_tag_by_id($artikel->tag_artikel) }}">
                        @if($errors->has('tag'))
                        <div class="small text-danger mt-1">{{ ucfirst($errors->first('tag')) }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kontributor</label>
                    <div class="col-md-10">
                        <select name="kontributor" class="form-control {{ $errors->has('kontributor') ? 'is-invalid' : '' }}" >
                            <option value="" disabled selected>--Pilih--</option>
                            @foreach($kontributor as $data)
                            <option value="{{ $data->id_kontributor }}" {{ $artikel->kontributor_artikel === $data->id_kontributor ? 'selected' : '' }}>{{ $data->kontributor }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('kontributor'))
                        <div class="small text-danger mt-1">{{ ucfirst($errors->first('kontributor')) }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Konten</label>
                    <div class="col-md-10">
                        <textarea name="konten" class="d-none"></textarea>
                        <div id="editor">{!! html_entity_decode($artikel->konten_artikel) !!}</div> 
                        @if($errors->has('konten'))
                        <div class="small text-danger mt-1">{{ ucfirst($errors->first('konten')) }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-theme-1 rounded-3 px-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('template.admin._modal-image', ['croppieWidth' => 640, 'croppieHeight' => 360])
  
@endsection

@section('js-extra')

@include('template.admin._js-image', ['imageType' => 'artikel', 'croppieWidth' => 640, 'croppieHeight' => 360])

@include('template.admin._js-editor')

@include('template.admin._js-tagsinput')

<script type="text/javascript">
    // Quill
    generate_quill("#editor");

    // Tagsinput
    generate_tagsinput("input[name=tag]");

    // Button Submit
    $(document).on("click", "button[type=submit]", function(e){
        var myEditor = document.querySelector('#editor');
        var html = myEditor.children[0].innerHTML;
        $("textarea[name=konten]").text(html);
        $("#form").submit();
    });
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}">

@endsection