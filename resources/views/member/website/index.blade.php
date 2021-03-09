@extends('template/member/main')

@section('title', 'Website')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/member"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/member/website">Website</a></li>
        <li class="breadcrumb-item active" aria-current="page">Website Kamu</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="m-0">Website</h5>
            <a href="/member/website/create" class="btn btn-light opacity-0 rounded-3">Tambah Website</a>
        </div>
        <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
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
                        <th>Domain</th>
                        <th>API Key</th>
                        <th width="100">Status</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($website)>0)
                        @php $i = 1; @endphp
                        @foreach($website as $data)
                        <tr>
                            <td align="center">{{ $i }}</td>
                            <td><a href="/member/website/detail/{{ $data->id_website }}">{{ $data->website_url }}</a></td>
                            <td>{{ $data->website_key }}</td>
                            <td>
                                @if($data->website_status == 1)
                                <span class="badge badge-success">Aktif</span>
                                @elseif($data->website_status == 2)
                                <span class="badge badge-warning">Menunggu instalasi dari pihak admin</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ $data->website_url }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Lihat Website" target="_blank"><i class="fa fa-eye"></i></a>
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