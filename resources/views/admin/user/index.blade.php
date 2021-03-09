@extends('template/admin/main')

@section('title', 'User')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/user">Pengguna</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="m-0">Data Pengguna</h5>
            <a href="/admin/user/create" class="btn btn-light opacity-1 rounded-3">Tambah Pengguna</a>
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
                        <th>Pengguna</th>
                        <th width="100">Role</th>
                        <th width="80">Status</th>
                        <th width="100">Waktu</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($user)>0)
                        @php $i = 1; @endphp
                        @foreach($user as $data)
                        <tr>
                            <td align="center">{{ $i }}</td>
                            <td>
                                <a href="/admin/user/detail/{{ $data->id_user }}">{{ $data->nama_user }}</a>
                                <br>
                                <span class="small text-muted">{{ $data->email }}</span>
                            </td>
                            <td>{{ $data->nama_role }}</td>
                            <td><span class="badge {{ $data->status == 1 && $data->email_verified == 1 ? 'bg-success' : 'bg-warning' }}">{{ $data->status == 1 && $data->email_verified == 1 ? 'Aktif' : 'Belum Aktif' }}</span></td>
                            <td>
                                <span class="d-none">{{ $data->register_at }}</span>
                                {{ date('d/m/Y', strtotime($data->register_at)) }}
                                <br>
                                <span class="small text-muted">{{ date('H:i', strtotime($data->register_at)) }} WIB</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="/admin/user/detail/{{ $data->id_user }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Detail User"><i class="fa fa-eye"></i></a>
                                    <a href="/admin/user/edit/{{ $data->id_user }}" class="btn btn-sm btn-theme-1" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                    @if($data->role == role_member())
                                    <a href="#" class="btn btn-sm btn-theme-1 btn-delete" data-id="{{ $data->id_user }}" data-toggle="tooltip" title="Hapus User"><i class="fa fa-trash"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <form id="form-delete" class="d-none" method="post" action="/admin/user/delete">
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
    // Datatable
    $(document).ready(function(){
        $("#table").DataTable();
    });

    // Button Delete
    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete input[name=id]").val(id);
            $("#form-delete").submit();
        }
    });
</script>
  
@endsection

@section('css-extra')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"/>
<style>
    .badge {font-weight: 500;}
</style>
  
@endsection