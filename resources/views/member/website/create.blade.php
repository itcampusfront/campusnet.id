@extends('template/member/main')

@section('title', 'Tambah Website')

@section('content')

<div class="content">
    @include('template/member/_order-now')
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Tambah Website</h5>
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
                    <button type="submit" class="btn btn-theme-1">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
  
@endsection