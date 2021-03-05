@extends('template/admin/main')

@section('title', 'Data Progress '.ucfirst($category))

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-percent"></i> Data Progress {{ ucfirst($category) }}</h1>
      <p>Menu untuk mengelola data progress {{ $category }}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/progress">Progress</a></li>
      <li class="breadcrumb-item">Data Progress {{ ucfirst($category) }}</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Progress {{ ucfirst($category) }}</h3>
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
                        <th>Tugas</th>
                        <th>User</th>
                        <th width="80">Status</th>
                        <th width="100">Waktu</th>
                        @if($category == 'tugas')
                        <th width="40">Nilai</th>
                        @endif
                        <th width="40">Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($progress as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href="/admin/konten/detail/{{ $data->id_konten }}">{{ $data->konten['nama'] }}</a></td>
                                <td><a href="/admin/user/detail/{{ $data->id_user }}">{{ $data->nama_user }}</a></td>
                                <td><span class="font-weight-bold {{ $data->progress == 1 ? 'text-success' : 'text-danger' }}">{{ $data->progress == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</span></td>
                                <td><span data-toggle="tooltip" title="{{ date('d/m/Y H:i:s', strtotime($data->progress_at)) }}"><span class="hidden-date">{{ $data->progress_at }}</span>{{ date('d/m/Y', strtotime($data->progress_at)) }}</span></td>
                                @if($category == 'tugas')
                                <td><a href="#" class="btn btn-warning btn-sm btn-block btn-score" data-id="{{ $data->id_progress }}" data-nama="{{ $data->nama_user }}" data-file="{{ asset('assets/files/upload-tugas/'.$data->progress_keterangan['file']) }}" data-keterangan="{{ $data->progress_keterangan['keterangan'] }}" data-nilai="{{ array_key_exists('nilai',$data->progress_keterangan) ? $data->progress_keterangan['nilai'] : '' }}" data-toggle="tooltip" title="Beri Penilaian"><i class="fa fa-edit"></i></a></td>
                                @endif
                                <td><a href="#" class="btn btn-danger btn-sm btn-block btn-delete" data-id="{{ $data->id_progress }}" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form id="form-delete" class="d-none" method="post" action="/admin/progress/{{ $category }}/delete">
                {{ csrf_field() }}
                <input type="hidden" name="id">
            </form>
        </div>
      </div>
    </div>
  </div>
</main>

@if($category == 'tugas')
<!-- Modal -->
<div class="modal fade" id="modal-score" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beri Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-score" method="post" action="/admin/progress/tugas/beri-penilaian">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <a href="#" class="btn btn-info btn-block btn-file-tugas" target="_blank"><i class="fa fa-eye mr-2"></i>Lihat File Tugas</a>
                    </div>
                    <div class="form-group">
                        <label>Keterangan:</label>
                        <textarea class="form-control keterangan" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nilai:</label>
                        <input type="number" name="nilai" class="form-control {{ $errors->has('nilai') ? 'border-danger' : '' }}" placeholder="Beri Nilai">
                        @if($errors->has('nilai'))
                        <div class="small mt-1 text-danger">Skala nilai dari 0 sampai 100!</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('js-extra')

<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    // DataTable
    $('#table').DataTable();

    // Button Score
    $(document).on("click", ".btn-score", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var file = $(this).data("file");
        var keterangan = $(this).data("keterangan");
        var nilai = $(this).data("nilai");
        $("#form-score").find("input[name=id]").val(id);
        $("#form-score").find("input[name=nama]").val(nama);
        $("#form-score").find(".btn-file-tugas").attr("href",file);
        $("#form-score").find(".keterangan").val(keterangan);
        if(nilai != ''){
            $("#form-score").find("input[name=nilai]").val(nilai).attr("readonly","readonly");
            $("#modal-score").find("button[type=submit]").attr("disabled","disabled");
        }
        else{
            $("#form-score").find("input[name=nilai]").removeAttr("readonly");
            $("#modal-score").find("button[type=submit]").removeAttr("disabled");
        }
        $("#modal-score").modal("toggle");
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

    // Input Nilai
    $(document).on("change", "input[name=nilai]", function(){
        var nilai = $(this).val();
        if(nilai < 0 || nilai > 100){
            alert("Skala nilai dari 0 sampai 100!");
            $(this).val(null);
        }
    });
</script>

@if(count($errors)>0)
<script type="text/javascript">
    $("#modal-score").modal("toggle");
</script>
@endif

@endsection