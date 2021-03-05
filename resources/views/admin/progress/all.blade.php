@extends('template/admin/main')

@section('title', 'Data Progress')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-percent"></i> Data Progress</h1>
      <p>Menu untuk mengelola data progress</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/progress">Progress</a></li>
      <li class="breadcrumb-item">Data Progress</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Progress</h3>
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
                        <th>Kelas</th>
                        <th>User</th>
                        <th width="80">Progress (%)</th>
                        <th width="100">Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($progress as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href="/admin/kelas/detail/{{ $data->id_kelas }}">{{ $data->nama_kelas }}</a></td>
                                <td><a href="/admin/user/detail/{{ $data->id_user }}">{{ $data->nama_user }}</a></td>
                                <td>{{ percentage_completed_tasks($data->id_user, $data->id_kelas) }}</td>
                                <td><span data-toggle="tooltip" title="{{ date('d/m/Y H:i:s', strtotime($data->mk_at)) }}"><span class="hidden-date">{{ $data->mk_at }}</span>{{ date('d/m/Y', strtotime($data->mk_at)) }}</span></td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
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
</script>

@endsection