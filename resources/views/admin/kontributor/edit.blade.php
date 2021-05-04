@extends('template.admin.main')

@section('title', 'Edit Kontributor')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.kontributor.index') }}">Kontributor</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kontributor</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Edit Kontributor</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.artikel.kontributor.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $kontributor->id_kontributor }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kontributor <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" name="kontributor" class="form-control {{ $errors->has('kontributor') ? 'border-danger' : '' }}" value="{{ $kontributor->kontributor }}">
                        @if($errors->has('kontributor'))
                        <div class="small text-danger">{{ ucfirst($errors->first('kontributor')) }}</div>
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