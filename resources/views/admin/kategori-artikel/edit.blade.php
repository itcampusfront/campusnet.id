@extends('template.admin.main')

@section('title', 'Edit Kategori Artikel')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.kategori.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kategori Artikel</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Edit Kategori</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.artikel.kategori.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $kategori->id_ka }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" name="kategori" class="form-control {{ $errors->has('kategori') ? 'border-danger' : '' }}" value="{{ $kategori->kategori }}">
                        @if($errors->has('kategori'))
                        <div class="small text-danger">{{ ucfirst($errors->first('kategori')) }}</div>
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
  
@endsection