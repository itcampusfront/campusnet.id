@extends('template/admin/main')

@section('title', 'Artikel')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/artikel">Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Artikel</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Data Artikel</h5>
            <a href="/admin/artikel/create" class="btn btn-light opacity-0 rounded-3">Tambah Artikel</a>
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
                        <th>Artikel</th>
                        <th width="100">Waktu</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($artikel)>0)
                        @php $i = 1; @endphp
                        @foreach($artikel as $data)
                        <tr>
                            <td align="center">{{ $i }}</td>
                            <td>
                                <a href="/admin/artikel/detail/{{ $data->id_artikel }}">{{ $data->judul_artikel }}</a>
                            </td>
                            <td>
                                <span class="d-none">{{ $data->artikel_at }}</span>
                                {{ date('d/m/Y', strtotime($data->artikel_at)) }}
                                <br>
                                <span class="small text-muted">{{ date('H:i', strtotime($data->artikel_at)) }} WIB</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="/admin/artikel/detail/{{ $data->id_artikel }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Detail"><i class="fa fa-eye"></i></a>
                                    <a href="/admin/artikel/edit/{{ $data->id_artikel }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-theme-1 btn-delete" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
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