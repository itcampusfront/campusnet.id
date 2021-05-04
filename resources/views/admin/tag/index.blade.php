@extends('template.admin.main')

@section('title', 'Data Tag')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.tag.index') }}">Tag</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Tag</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Data Tag</h5>
            <a href="{{ route('admin.artikel.tag.create') }}" class="btn btn-light opacity-0 rounded-3">Tambah Tag</a>
        </div>
        <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="table-responsive mt-2">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="30">No.</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th width="40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tag)>0)
                        @php $i = 1; @endphp
                        @foreach($tag as $data)
                        <tr>
                            <td align="center">{{ $i }}</td>
                            <td>{{ $data->tag }}</td>
                            <td>{{ $data->slug }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.artikel.tag.edit', ['id' => $data->id_tag]) }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-theme-1 btn-delete" data-id="{{ $data->id_tag }}" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <form id="form-delete" class="d-none" method="post" action="{{ route('admin.artikel.tag.delete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id">
            </form>
        </div>
        </div>
    </div>
</div>
  
@endsection

@section('js-extra')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#table").DataTable();
    });
</script>
  
@endsection

@section('css-extra')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"/>
<style>
    .badge {font-weight: 500;}
</style>
  
@endsection