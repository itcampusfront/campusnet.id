@extends('template/admin/main')

@section('title', 'Website')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/website">Website</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Website</li>
    </ol>
</nav>
<div class="content">
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Data Website</h5>
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
                        <th>Domain</th>
                        <th>User</th>
                        <th width="100">Waktu</th>
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
                            <td>
                                <a href="/admin/website/detail/{{ $data->id_website }}">{{ $data->website_url }}</a>
                                <br>
                                <span class="small text-muted"><strong>API Key:</strong> {{ $data->website_key }}</span>
                            </td>
                            <td>
                                <a href="/admin/user/detail/{{ $data->id_user }}">{{ $data->nama_user }}</a>
                                <br>
                                <span class="small text-muted">{{ $data->email }}</span>
                            </td>
                            <td>
                                <span class="d-none">{{ $data->website_at }}</span>
                                {{ date('d/m/Y', strtotime($data->website_at)) }}
                                <br>
                                <span class="small text-muted">{{ date('H:i', strtotime($data->website_at)) }} WIB</span>
                            </td>
                            <td>
                                @if($data->website_status == 1)
                                <span class="badge badge-success">Aktif</span>
                                @elseif($data->website_status == 2)
                                <span class="badge badge-warning">Menunggu instalasi dari pihak admin</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ $data->website_url }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Lihat Website" target="_blank"><i class="fa fa-eye"></i></a>
                                    @if($data->website_status == 2)
                                    <a href="/admin/website/activation/{{ $data->id_website }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Aktivasi"><i class="fa fa-check"></i></a>
                                    @endif
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