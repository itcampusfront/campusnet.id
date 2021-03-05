@extends('template/admin/main')

@section('title', 'Data Kelas')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list"></i> Data Kelas</h1>
      <p>Menu untuk mengelola data kelas</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/kelas">Kelas</a></li>
      <li class="breadcrumb-item">Data Kelas</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Kelas</h3>
          <div class="btn-group">
            <a class="btn btn-primary" href="/admin/kelas/create" title="Tambah Kelas"><i class="fa fa-lg fa-plus"></i></a>
            <!-- <a class="btn btn-primary" href="/admin/kelas/export" title="Export Data kelas"><i class="fa fa-lg fa-file-excel-o"></i></a> -->
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
                        <th>Nama Kelas</th>
                        <th width="100">Kategori</th>
                        <th width="100">Author</th>
                        <th width="40">Edit</th>
                        <th width="40">Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($kelas as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href="/admin/kelas/detail/{{ $data->id_kelas }}">{{ $data->nama_kelas }}</a><br><small class="text-secondary">{{ URL::to('kelas/'.$data->slug_kelas) }}</small></td>
                                <td>{{ $data->nama_kategori }}</td>
                                <td><a href="/admin/user/detail/{{ $data->id_user }}">{{ $data->nama_user }}</a></td>
                                <td><a href="/admin/kelas/edit/{{ $data->id_kelas }}" class="btn btn-warning btn-sm btn-block" data-id="{{ $data->id_kelas }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a></td>
                                <td><a href="#" class="btn btn-danger btn-sm btn-block btn-delete" data-id="{{ $data->id_kelas }}" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form id="form-delete" class="d-none" method="post" action="/admin/kelas/delete">
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