@extends('template/admin/main')

@section('title', 'Edit Testimoni')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/testimoni">Testimoni</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Testimoni</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Edit Testimoni</h5>
        </div>
        <div class="card-body">
        <form method="post" action="/admin/testimoni/update">
        <input type="hidden" name="id" value="{{ $testimoni->id_testimoni }}">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Nama Klien <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="klien" class="form-control {{ $errors->has('klien') ? 'border-danger' : '' }}" value="{{ $testimoni->klien }}" placeholder="Masukkan Nama Klien">
                    @if($errors->has('klien'))
                    <div class="small text-danger">{{ ucfirst($errors->first('klien')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Ucapan Testimoni <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <textarea name="ucapan_testimoni" class="form-control {{ $errors->has('ucapan_testimoni') ? 'border-danger' : '' }}" rows="3" placeholder="Masukkan Ucapan Testimoni">{{ $testimoni->ucapan_testimoni }}</textarea>
                    @if($errors->has('ucapan_testimoni'))
                    <div class="small text-danger">{{ ucfirst($errors->first('ucapan_testimoni')) }}</div>
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