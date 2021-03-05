@extends('template/admin/main')

@section('title', 'Data User')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> Data User</h1>
      <p>Menu untuk mengelola data user</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/user">User</a></li>
      <li class="breadcrumb-item">Data User</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title-w-btn">
          <h3 class="title">Data User</h3>
          <div class="btn-group">
            <a class="btn btn-primary" href="/admin/user/create" title="Tambah User"><i class="fa fa-lg fa-plus"></i></a>
            <!-- <a class="btn btn-primary" href="/admin/user/export" title="Export Data User"><i class="fa fa-lg fa-file-excel-o"></i></a> -->
          </div>
        </div>
        <div class="tile-body">
            @if(Session::get('message') != null)
            <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="table">
                    <thead>
                    <tr>
                        <th width="30">No.</th>
                        <th>Identitas</th>
                        <th width="80">Role</th>
                        <th width="80">Status</th>
                        <th width="150">Waktu</th>
                        <th width="40">Edit</th>
                        <th width="40">Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($user as $data)
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->nama_user }}<br><small class="text-secondary">{{ $data->email }}</small></td>
                            <td>{{ $data->nama_role }}</td>
                            <td>{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td><span class="date-hidden">{{ date('Ymd', strtotime($data->register_at)) }}</span>{{ date('d/m/Y H:i:s', strtotime($data->register_at)) }}</td>
                            <td><a href="/admin/user/edit/{{ $data->id_user }}" class="btn btn-warning btn-sm btn-block" data-id="{{ $data->id_user }}" title="Edit"><i class="fa fa-edit"></i></a></td>
                            @if(Auth::user()->role == role_admin())
                            <td><a href="#" class="btn btn-danger btn-sm btn-block {{ $data->id_user > 1 ? 'btn-delete' : '' }}" data-id="{{ $data->id_user }}" style="{{ $data->id_user > 1 ? '' : 'cursor: not-allowed' }}" title="{{ $data->id_user <= 1 ? $data->id_user == Auth::user()->id_user ? 'Tidak dapat menghapus akun sendiri' : 'Akun ini tidak boleh dihapus' : 'Hapus' }}"><i class="fa fa-trash"></i></a></td>
                            @elseif(Auth::user()->role == role_manager())
                            <td><a href="#" class="btn btn-danger btn-sm btn-block {{ $data->id_user != Auth::user()->id_user && $data->id_user != 1 ? 'btn-delete' : '' }}" data-id="{{ $data->id_user }}" style="{{ $data->id_user != Auth::user()->id_user && $data->id_user != 1 ? '' : 'cursor: not-allowed' }}" title="{{ $data->id_user == Auth::user()->id_user ? 'Tidak dapat menghapus akun sendiri' : 'Hapus' }}"><i class="fa fa-trash"></i></a></td>
                            @endif
                          </tr>
                          @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form id="form-delete" class="d-none" method="post" action="/admin/user/delete">
                {{ csrf_field() }}
                <input type="hidden" name="id">
            </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection

@section('js-extra')

<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  // DataTable
  $('#table').DataTable();

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

<style type="text/css">
  .date-hidden {display: none;}
</style>

@endsection