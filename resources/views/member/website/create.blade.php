@extends('template/member/main')

@section('title', 'Tambah Website')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/member"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/member/website">Website</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Website</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Tambah Website</h5>
        </div>
        <div class="card-body">
        <form method="post" action="/member/website/store">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Domain</label>
                <div class="col-md-10">
                    <input type="text" name="website_url" class="form-control {{ $errors->has('website_url') ? 'border-danger' : '' }}" placeholder="Contoh: https://example.com">
                    @if($errors->has('website_url'))
                    <div class="small text-danger">{{ ucfirst($errors->first('website_url')) }}</div>
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