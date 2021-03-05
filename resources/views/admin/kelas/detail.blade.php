@extends('template/admin/main')

@section('title', 'Detail Kelas')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list"></i> Detail Kelas</h1>
      <p>Menu untuk menampilkan detail data kelas</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/kelas">Kelas</a></li>
      <li class="breadcrumb-item">Detail Kelas</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab" aria-controls="pills-detail" aria-selected="true"><i class="fa fa-info-circle mr-2"></i>Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-materi-tab" data-toggle="pill" href="#pills-materi" role="tab" aria-controls="pills-materi" aria-selected="false"><i class="fa fa-tags mr-2"></i>Materi</a>
                </li>
            </ul>
            <div class="tab-content py-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="form-group">
                                <a href="/admin/kelas/edit/{{ $kelas->id_kelas }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-edit mr-2"></i>Edit Kelas</a>
                            </div>  
                            <div class="form-group">
                                <img src="{{ asset('assets/images/kelas/'.$kelas->gambar_kelas) }}" class="img-thumbnail" width="250">
                            </div>
                            <div class="form-group">
                                <label>Nama Kelas:</label><br>{{ $kelas->nama_kelas }}
                            </div>
                            <div class="form-group">
                                <label>Kategori:</label><br>{{ $kelas->nama_kategori }}
                            </div>
                            <div class="form-group">
                                <label>Level:</label><br>{{ $kelas->nama_level }}
                            </div>
                            <div class="form-group">
                                <label>Pengajar:</label><br>{{ $kelas->nama_user }}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Deskripsi:</label>
                                <div class="ql-snow"><div class="ql-editor p-0">{!! html_entity_decode($kelas->deskripsi_kelas) !!}</div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
                    <div class="form-group">
                        <a href="#" class="btn btn-sm btn-primary btn-add-topik"><i class="fa fa-plus mr-2"></i>Tambah Topik</a>
                    </div>
                    @if(Session::get('message') != null)
                    <div class="alert alert-dismissible alert-success">
                        <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                    </div>
                    @endif
                    @if(isset($_GET) && isset($_GET['addkonten']))
                    <div class="alert alert-dismissible alert-success">
                        <button class="close" type="button" data-dismiss="alert">×</button>Berhasil menambahkan / mengupdate data.
                    </div>
                    @endif
                    @if(count($topik)>0)
                        <div class="sortable-topik" data-kelas="{{ $kelas->id_kelas }}">
                        @foreach($topik as $key=>$data)
                            <div class="tile-topik" data-id="{{ $data->id_topik }}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm"><h4><i class="fa fa-arrows-alt mr-2"></i>{{ $data->nama_topik }}</h4></div>
                                            <div class="col-sm-auto btn-group">
                                                <a href="#" class="btn btn-sm btn-primary btn-add-konten" title="Tambah Konten" data-id="{{ $data->id_topik }}" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                                                <a href="#" class="btn btn-sm btn-primary btn-edit-topik" title="Edit Topik" data-id="{{ $data->id_topik }}" data-nama="{{ $data->nama_topik }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-primary btn-delete-topik" title="Hapus Topik" data-id="{{ $data->id_topik }}" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if(count($data->konten)>0)
                                            <div class="sortable-konten" data-topik="{{ $data->id_topik }}">
                                            @foreach($data->konten as $key2=>$data2)
                                                <div class="list-group-item d-flex justify-content-between align-items-center tile-konten" data-id="{{ $data2->id_konten }}">
                                                    <div class="d-flex justify-content-between w-100">
                                                        @php
                                                            $json_decode = $data2->konten != '' ? json_decode($data2->konten, true) : '';
                                                        @endphp
                                                        <span>
                                                            <i class="fa fa-arrows-alt mr-2"></i>
                                                            @if($data2->jenis_konten == 1)
                                                                <i class="fa fa-text-height mr-2" data-toggle="tooltip" title="Konten Teks"></i>
                                                                <a href="#">
                                                                    {{ $data2->konten != '' ? $json_decode['nama'] : '' }}
                                                                </a>
                                                            @elseif($data2->jenis_konten == 2)
                                                                <i class="fa fa-video-camera mr-2" data-toggle="tooltip" title="Konten Video"></i>
                                                                <a href="{{ $json_decode['tipe'] == 'youtube' ? $json_decode['video'] : URL::to('/assets/videos/konten-video/'.$json_decode['video']) }}">
                                                                    {{ $data2->konten != '' ? $json_decode['nama'] : '' }}
                                                                </a>
                                                            @elseif($data2->jenis_konten == 3)
                                                                <i class="fa fa-file-o mr-2" data-toggle="tooltip" title="Konten File"></i>
                                                                <a href="{{ URL::to('/assets/files/konten-file/'.$json_decode['file']) }}">
                                                                    {{ $data2->konten != '' ? $json_decode['nama'] : '' }}
                                                                </a>
                                                            @elseif($data2->jenis_konten == 4)
                                                                <i class="fa fa-question mr-2" data-toggle="tooltip" title="Konten Kuis"></i>
                                                                <a href="{{ $data2->konten != '' ? $json_decode['kuis'] : '' }}">
                                                                    {{ $data2->konten != '' ? $json_decode['nama'] : '' }}
                                                                </a>
                                                            @elseif($data2->jenis_konten == 5)
                                                                <i class="fa fa-tasks mr-2" data-toggle="tooltip" title="Konten Tugas"></i>
                                                                <a href="#">
                                                                    {{ $data2->konten != '' ? $json_decode['nama'] : '' }}
                                                                </a>
                                                            @endif
                                                        </span>
                                                        @if($data2->jenis_konten == 2 && $json_decode['tipe'] == 'youtube')
                                                            <span class="mx-3"><i class="fa fa-clock-o mr-1"></i>{{ generate_video_time($json_decode['durasi']) }}</span>
                                                        @elseif($data2->jenis_konten == 2 && $json_decode['tipe'] == 'file')
                                                            <span class="mx-3"><i class="fa fa-clock-o mr-1"></i>{{ generate_video_time(get_video_time($json_decode['video'])) }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-primary btn-edit-konten" title="Edit Konten" data-id="{{ $data2->id_konten }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                        <a href="#" class="btn btn-sm btn-primary btn-delete-konten" title="Hapus Konten" data-id="{{ $data2->id_konten }}" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-danger text-center mb-0">
                                                Belum ada konten tersedia.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            Belum ada materi / topik tersedia.
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal Tambah Topik -->
<div class="modal fade" id="modal-add-topik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Topik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/admin/kelas/add-topik">
                {{ csrf_field() }}
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Topik <span class="text-danger">*</span></label>
                        <input type="text" name="nama_topik" class="form-control" placeholder="Masukkan Nama Topik" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Tambah Topik -->

<!-- Modal Edit Topik -->
<div class="modal fade" id="modal-edit-topik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Topik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/admin/kelas/update-topik">
                {{ csrf_field() }}
                <input type="hidden" name="id_topik">
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Topik <span class="text-danger">*</span></label>
                        <input type="text" name="nama_topik" class="form-control" placeholder="Masukkan Nama Topik" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Topik -->

<!-- Form Delete Topik -->
<form id="form-delete-topik" class="d-none" method="post" action="/admin/kelas/delete-topik">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>
<!-- End Form Delete Topik -->

<!-- Modal Tambah Konten -->
<div class="modal fade" id="modal-add-konten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Konten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/admin/kelas/add-konten" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <input type="hidden" name="id_topik">
                <input type="hidden" name="jenis_konten" value="1">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab-1" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-tab-teks-1" data-id="1" data-toggle="pill" href="#v-pills-teks-1" role="tab" aria-controls="v-pills-teks-1" aria-selected="true"><i class="fa fa-text-height mr-2"></i>Teks</a>
                                <a class="nav-link" id="v-pills-tab-video-1" data-id="2" data-toggle="pill" href="#v-pills-video-1" role="tab" aria-controls="v-pills-video-1" aria-selected="false"><i class="fa fa-video-camera mr-2"></i>Video</a>
                                <a class="nav-link" id="v-pills-tab-file-1" data-id="3" data-toggle="pill" href="#v-pills-file-1" role="tab" aria-controls="v-pills-file-1" aria-selected="false"><i class="fa fa-file-o mr-2"></i>File</a>
                                <a class="nav-link" id="v-pills-tab-kuis-1" data-id="4" data-toggle="pill" href="#v-pills-kuis-1" role="tab" aria-controls="v-pills-kuis-1" aria-selected="false"><i class="fa fa-question mr-2"></i>Kuis</a>
                                <a class="nav-link" id="v-pills-tab-tugas-1" data-id="5" data-toggle="pill" href="#v-pills-tugas-1" role="tab" aria-controls="v-pills-tugas-1" aria-selected="false"><i class="fa fa-tasks mr-2"></i>Tugas</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content py-3" id="v-pills-tabContent-1">
                                <div class="tab-pane fade show active" id="v-pills-teks-1" role="tabpanel" aria-labelledby="v-pills-tab-teks-1">
                                    <div class="form-group">
                                        <label>Judul Konten <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_teks" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Konten <span class="text-danger">*</span></label>
                                        <textarea name="konten_teks" class="form-control d-none" rows="3"></textarea>
                                        <div id="editor-1"></div> 
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-video-1" role="tabpanel" aria-labelledby="v-pills-tab-video-1">
                                    <div class="form-inline">
                                        <a href="#" class="btn btn-primary btn-upload-video" data-tipe="add"><i class="fa fa-upload mr-2"></i>Upload Video</a>
                                        <input type="file" class="d-none" id="add-video" accept="video/mp4,video/x-m4v,video/*">
                                        <p class="m-2">atau</p>
                                        <input type="text" name="konten_video" class="form-control" placeholder="Masukkan URL YouTube disini">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-file-1" role="tabpanel" aria-labelledby="v-pills-tab-file-1">
                                    <a href="#" class="btn btn-primary btn-upload-file" data-tipe="add"><i class="fa fa-upload mr-2"></i>Upload File</a>
                                    <input type="file" class="d-none" id="add-file">
                                </div>
                                <div class="tab-pane fade" id="v-pills-kuis-1" role="tabpanel" aria-labelledby="v-pills-tab-kuis-1">
                                    <div class="form-group">
                                        <label>Judul Kuis <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_kuis" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>URL Embed Kuis <span class="text-danger">*</span></label>
                                        <input type="text" name="konten_kuis" class="form-control mb-2">
                                        <a class="font-weight-bold" href="/quiz/create" target="_blank">Buat Kuis disini</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-tugas-1" role="tabpanel" aria-labelledby="v-pills-tab-tugas-1">
                                    <div class="form-group">
                                        <label>Judul Tugas <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_tugas" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Tugas <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_tugas" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Pengumpulan Tugas <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="waktu_tugas" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-submit btn-submit-add-konten"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Tambah Konten -->

<!-- Modal Edit Konten -->
<div class="modal fade" id="modal-edit-konten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Konten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/admin/kelas/update-konten" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_konten">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab-2" role="tablist" aria-orientation="vertical">
                                <a class="nav-link" id="v-pills-tab-teks-2" data-id="1" data-toggle="pill" href="#v-pills-teks-2" role="tab" aria-controls="v-pills-teks-2" aria-selected="true"><i class="fa fa-text-height mr-2"></i>Teks</a>
                                <a class="nav-link" id="v-pills-tab-video-2" data-id="2" data-toggle="pill" href="#v-pills-video-2" role="tab" aria-controls="v-pills-video-2" aria-selected="false"><i class="fa fa-video-camera mr-2"></i>Video</a>
                                <a class="nav-link" id="v-pills-tab-file-2" data-id="3" data-toggle="pill" href="#v-pills-file-2" role="tab" aria-controls="v-pills-file-2" aria-selected="false"><i class="fa fa-file-o mr-2"></i>File</a>
                                <a class="nav-link" id="v-pills-tab-kuis-2" data-id="4" data-toggle="pill" href="#v-pills-kuis-2" role="tab" aria-controls="v-pills-kuis-2" aria-selected="false"><i class="fa fa-question mr-2"></i>Kuis</a>
                                <a class="nav-link" id="v-pills-tab-tugas-2" data-id="5" data-toggle="pill" href="#v-pills-tugas-2" role="tab" aria-controls="v-pills-tugas-2" aria-selected="false"><i class="fa fa-tasks mr-2"></i>Tugas</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content py-3" id="v-pills-tabContent-2">
                                <div class="tab-pane fade" id="v-pills-teks-2" role="tabpanel" aria-labelledby="v-pills-tab-teks-2">
                                    <div class="form-group">
                                        <label>Judul Konten <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_teks" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="konten_teks" class="form-control d-none" rows="3"></textarea>
                                        <div id="editor-2"></div> 
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-video-2" role="tabpanel" aria-labelledby="v-pills-tab-video-2">
                                    <div class="form-inline">
                                        <a href="#" class="btn btn-primary btn-upload-video" data-tipe="edit"><i class="fa fa-upload mr-2"></i>Upload Video</a>
                                        <input type="file" class="d-none" id="edit-video" accept="video/mp4,video/x-m4v,video/*">
                                        <p class="m-2">atau</p>
                                        <input type="text" name="konten_video" class="form-control" placeholder="Masukkan URL YouTube disini">
                                    </div>
                                    <br>
                                    <a class="font-weight-bold konten-video" href="" target="_blank"></a>
                                </div>
                                <div class="tab-pane fade" id="v-pills-file-2" role="tabpanel" aria-labelledby="v-pills-tab-file-2">
                                    <a href="#" class="btn btn-primary btn-upload-file" data-tipe="edit"><i class="fa fa-upload mr-2"></i>Upload File</a>
                                    <input type="file" class="d-none" id="edit-file">
                                    <br><br>
                                    <a class="font-weight-bold konten-file" href="" target="_blank"></a>
                                </div>
                                <div class="tab-pane fade" id="v-pills-kuis-2" role="tabpanel" aria-labelledby="v-pills-tab-kuis-2">
                                    <div class="form-group">
                                        <label>Judul Kuis <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_kuis" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>URL Embed Kuis <span class="text-danger">*</span></label>
                                        <input type="text" name="konten_kuis" class="form-control mb-2">
                                        <a class="font-weight-bold" href="/quiz/create" target="_blank">Buat Kuis disini</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-tugas-2" role="tabpanel" aria-labelledby="v-pills-tab-tugas-1">
                                    <div class="form-group">
                                        <label>Judul Tugas <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_tugas" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Tugas <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_tugas" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Pengumpulan Tugas <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="waktu_tugas" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-submit btn-submit-edit-konten"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Konten -->

<!-- Form Delete Konten -->
<form id="form-delete-konten" class="d-none" method="post" action="/admin/kelas/delete-konten">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>
<!-- End Form Delete Konten -->

<!-- Modal Loader -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5>Loading...</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Loader -->

@endsection

@section('js-extra')

<script type="text/javascript" src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    @if(isset($_GET['tab']))
        $('#pills-tab a[href="#pills-materi"]').tab('show');
    @endif

    // Button tambah topik
    $(document).on("click", ".btn-add-topik", function(e){
        e.preventDefault();
        $("#modal-add-topik").modal("show");
    });

    // Button edit topik
    $(document).on("click", ".btn-edit-topik", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        $("#modal-edit-topik input[name=id_topik]").val(id);
        $("#modal-edit-topik input[name=nama_topik]").val(nama);
        $("#modal-edit-topik").modal("show");
    });

    // Button hapus topik
    $(document).on("click", ".btn-delete-topik", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete-topik input[name=id]").val(id);
            $("#form-delete-topik").submit();
        }
    });

    // Sortable Topik
    $(".sortable-topik").sortable({
        placeholder: "ui-state-highlight",
        start: function(event, ui){
            $(".ui-state-highlight").css("height", $(ui.item).outerHeight());
        },
        update: function(event, ui){
            update_topik();
        }
    });
    $(".sortable-topik").disableSelection();

    // Button tambah konten
    $(document).on("click", ".btn-add-konten", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $('#v-pills-tab-1 a[href="#v-pills-teks-1"]').tab('show');
        $("#modal-add-konten input[name=id_topik]").val(id);
        $("#modal-add-konten input[name=jenis_konten]").val(1);
        $("#modal-add-konten").modal("show");
    });

    // Set jenis konten pada modal tambah konten
    $(document).on("click", "#v-pills-tab-1 .nav-link", function(){
        var id = $(this).data("id");
        $("#modal-add-konten input[name=jenis_konten]").val(id);
        customize_modal_konten("#modal-add-konten", id, "add");
    });
	
    // Submit tambah / edit konten
    $(document).on("click", ".btn-submit-add-konten, .btn-submit-edit-konten", function(e){
        e.preventDefault();
        var editor = $(this).hasClass("btn-submit-add-konten") ? "#editor-1" : "#editor-2";
        var modal = $(this).hasClass("btn-submit-add-konten") ? "#modal-add-konten" : "#modal-edit-konten";
        var myEditor = document.querySelector(editor);
        var html = myEditor.children[0].innerHTML;
        $(modal).find("textarea[name=konten_teks]").text(html);
        $(modal).find("form")[0].submit();
    });

    // Button edit konten
    $(document).on("click", ".btn-edit-konten", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: 'post',
            url: '/admin/kelas/edit-konten',
            data: {_token: "{{ csrf_token() }}", id: id},
            success: function(response){
                var result = JSON.parse(response);
                // console.log(result);

                // Select tab pane and disable nav-link
                $("#v-pills-tab-2 .nav-link").each(function(key,elem){
                    var jenis_konten = $(elem).data("id");
                    if(jenis_konten == result.jenis_konten){
                        $(elem).addClass("active");
                        var href = $(elem).attr("href");
                        $("#v-pills-tabContent-2").find(href).addClass("active show");
                        customize_modal_konten("#modal-edit-konten", result.jenis_konten, "edit", result.konten);
                    }
                    else{
                        $(elem).addClass("disabled");
                    }
                });
                $("#modal-edit-konten").find("input[name=id_konten]").val(result.id_konten);
                $("#modal-edit-konten").modal("show");
            }
        });
    });

    // Close modal edit konten
    $('#modal-edit-konten').on('hidden.bs.modal', function(e){
        // Hapus class active, disabled
        $("#v-pills-tab-2 .nav-link").each(function(key,elem){
            $(elem).removeClass("active disabled");
        });
        // Hapus class active, show
        $("#v-pills-tabContent-2 .tab-pane").each(function(key,elem){
            $(elem).removeClass("active show");
        });
    });

    // Button hapus konten
    $(document).on("click", ".btn-delete-konten", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete-konten input[name=id]").val(id);
            $("#form-delete-konten").submit();
        }
    });

    // Sortable Konten
    $(".sortable-konten").sortable({
        placeholder: "ui-state-highlight",
        start: function(event, ui){
            $(".ui-state-highlight").css("height", $(ui.item).outerHeight());
        },
        update: function(event, ui){
            update_konten();
        }
    });
    $(".sortable-konten").disableSelection();

    // Update urutan topik
    function update_topik(){
        var kelas = $(".sortable-topik").data("kelas");
        var ids = [];
        $(".tile-topik").each(function(key,elem){
            ids.push($(elem).data("id"));
        });
        $.ajax({
            type: "post",
            url: "/admin/kelas/sort-topik",
            data: {_token: "{{ csrf_token() }}", ids: ids, kelas: kelas},
            success: function(response){
                alert(response);
            }
        });
    }

    // Update urutan konten
    function update_konten(){
        var topik = $(".sortable-konten").data("topik");
        var ids = [];
        $(".tile-konten").each(function(key,elem){
            ids.push($(elem).data("id"));
        });
        $.ajax({
            type: "post",
            url: "/admin/kelas/sort-konten",
            data: {_token: "{{ csrf_token() }}", ids: ids, topik: topik},
            success: function(response){
                alert(response);
            }
        });
    }
</script>

<script>
    // Quill Editor
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        ['link', 'image', 'video'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'color': [] }, { 'background': [] }],
        ['clean']     
    ];

    var quill = new Quill('#editor-1', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Tulis sesuatu...',
        theme: 'snow',
        imageResize: {
            displayStyles: {
                backgroundColor: 'black',
                border: 'none',
                color: 'white'
            },
            modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
        }
    });

    var quill2 = new Quill('#editor-2', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Tulis sesuatu...',
        theme: 'snow',
        imageResize: {
            displayStyles: {
                backgroundColor: 'black',
                border: 'none',
                color: 'white'
            },
            modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
        }
    });

    // Button upload video
    $(document).on("click", ".btn-upload-video", function(e){
        e.preventDefault();
        var tipe = $(this).data("tipe");
        $("#"+tipe+"-video").trigger("click");
    });

    // Upload video
    $(document).on("change", "#add-video, #edit-video", function(){
        // tipe
        var tipe = $(this).attr("id") == "add-video" ? "add" : "edit";

        // ukuran maksimal upload file
        $max = 32 * 1024 * 1024;

        // validasi
        if(this.files && this.files[0]) {
            // jika ukuran melebihi batas maksimum
            if(this.files[0].size > $max){
                alert("Ukuran file terlalu besar dan melebihi batas maksimum!");
                $(this).val(null);
            }
            // jika ekstensi tidak diizinkan
            else if(!validate_video(this.files[0].name)){
                alert("Ekstensi file tidak diizinkan!");
                $(this).val(null);
            }
            // validasi sukses
            else{
                $("#modal-"+tipe+"-konten").modal("toggle");
                show_loader("Mengupload video...");
                upload_video(tipe);
            }
        }
    });

    // Button upload file
    $(document).on("click", ".btn-upload-file", function(e){
        e.preventDefault();
        var tipe = $(this).data("tipe");
        $("#"+tipe+"-file").trigger("click");
    });

    // Upload file
    $(document).on("change", "#add-file, #edit-file", function(){
        // tipe
        var tipe = $(this).attr("id") == "add-file" ? "add" : "edit";

        // ukuran maksimal upload file
        $max = 32 * 1024 * 1024;

        // validasi
        if(this.files && this.files[0]) {
            // jika ukuran melebihi batas maksimum
            if(this.files[0].size > $max){
                alert("Ukuran file terlalu besar dan melebihi batas maksimum!");
                $(this).val(null);
            }
            // jika ekstensi tidak diizinkan
            else if(!validate_file(this.files[0].name)){
                alert("Ekstensi file tidak diizinkan!");
                $(this).val(null);
            }
            // validasi sukses
            else{
                $("#modal-"+tipe+"-konten").modal("toggle");
                show_loader("Mengupload file...");
                upload_file(tipe);
            }
        }
    });

    function decode_html_entity(text) {
        return $("<textarea/>").html(text).text();
    }

    function customize_modal_konten(modal, jenis_konten, tipe, value = ''){
        // Jika jenis konten adalah teks
        if(jenis_konten == 1){
            if(tipe == "edit"){
                konten_teks = JSON.parse(value);
                $(modal).find("input[name=judul_teks]").attr("required","required").val(konten_teks.nama);
                $(modal).find(".btn-submit").addClass("btn-submit-"+tipe+"-konten");
                $(modal).find("#editor-2 .ql-editor").html(decode_html_entity(konten_teks.teks));
            }
            else{
                $(modal).find("input[name=judul_teks]").attr("required","required").val(value);
                $(modal).find(".btn-submit").addClass("btn-submit-"+tipe+"-konten");
            }
        }
        else{
            $(modal).find("input[name=judul_teks]").removeClass("required");
            $(modal).find(".btn-submit").removeClass("btn-submit-"+tipe+"-konten");
            if(tipe == "edit") $(modal).find("#editor-2 .ql-editor").html(null);
        }

        // Jika jenis konten adalah video
        if(jenis_konten == 2){
            if(value.search("https://") >= 0) $(modal).find("input[name=konten_video]").attr("required","required").val(value);
            else if(value.search("https://") < 0 && tipe == "edit") $(modal).find(".konten-video").html("<i class='fa fa-video-camera mr-2'></i>" + "{{ URL::to('/assets/videos/konten-video') }}/" + value).attr("href","{{ URL::to('/assets/videos/konten-video') }}/" + value);
            else if(value.search("https://") < 0) $(modal).find("input[name=konten_video]").attr("required","required").val(null);
        }
        else $(modal).find("input[name=konten_video]").removeAttr("required").val(null);

        // Jika jenis konten adalah file
        if(jenis_konten == 3){
            $(modal).find(".btn-submit").attr("disabled","disabled");
            if(tipe == "edit") $(modal).find(".konten-file").html("<i class='fa fa-file-o mr-2'></i>" + "{{ URL::to('/assets/files/konten-file') }}/" + value).attr("href","{{ URL::to('/assets/files/konten-file') }}/" + value);
        }
        else{
            $(modal).find(".btn-submit").removeAttr("disabled");
            if(tipe == "edit") $(modal).find(".konten-file").html('').attr("href","#");
        }

        // Jika jenis konten adalah kuis
        if(jenis_konten == 4){
            if(tipe == "edit"){
                konten_kuis = JSON.parse(value);
                $(modal).find("input[name=judul_kuis]").attr("required","required").val(konten_kuis.nama);
                $(modal).find("input[name=konten_kuis]").attr("required","required").val(konten_kuis.kuis);
            }
            else{
                $(modal).find("input[name=judul_kuis]").attr("required","required").val(value);
                $(modal).find("input[name=konten_kuis]").attr("required","required").val(value);
            }
        }
        else{
            $(modal).find("input[name=judul_kuis]").removeAttr("required");
            $(modal).find("input[name=konten_kuis]").removeAttr("required");
        }

        // Jika jenis konten adalah tugas
        if(jenis_konten == 5){
            if(tipe == "edit"){
                konten_tugas = JSON.parse(value);
                $(modal).find("input[name=judul_tugas]").attr("required","required").val(konten_tugas.nama);
                $(modal).find("textarea[name=deskripsi_tugas]").attr("required","required").val(konten_tugas.deskripsi);
                split_waktu = konten_tugas.waktu.split(" - ");
                // Daterangepicker
                $(modal).find("input[name=waktu_tugas]").daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    showDropdowns: true,
                    startDate: split_waktu[0],
                    endDate: split_waktu[1],
                    locale: {
                        format: 'DD/MM/YYYY HH:mm'
                    }
                });
            }
            else{
                $(modal).find("input[name=judul_tugas]").attr("required","required");
                $(modal).find("textarea[name=deskripsi_tugas]").attr("required","required");
                $(modal).find("input[name=waktu_tugas]").attr("required","required");
            }
        }
        else{
            $(modal).find("input[name=judul_tugas]").removeAttr("required");
            $(modal).find("textarea[name=deskripsi_tugas]").removeAttr("required");
            $(modal).find("input[name=waktu_tugas]").removeAttr("required");
        }
    }

    function upload_video(tipe) {
        // Get parameter
        var file = document.getElementById(tipe+"-video").files[0];
        var id_topik = $("#modal-"+tipe+"-konten input[name=id_topik]").length > 0 ? $("#modal-"+tipe+"-konten input[name=id_topik]").val() : 0;
        var id_konten = $("#modal-"+tipe+"-konten input[name=id_konten]").length > 0 ? $("#modal-"+tipe+"-konten input[name=id_konten]").val() : 0;
        var formdata = new FormData();
        formdata.append("datafile", file);
        formdata.append("id_topik", id_topik);
        formdata.append("id_konten", id_konten);
        formdata.append("_token", "{{ csrf_token() }}");
        
        // Proses upload via AJAX disubmit ke Controller
        // Selama proses upload, akan menjalankan progress_handler()
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progress_handler, false);
        ajax.open("POST", "/admin/kelas/upload-video", true);
        ajax.send(formdata);
    }

    function upload_file(tipe) {
        // Get parameter
        var file = document.getElementById(tipe+"-file").files[0];
        var id_topik = $("#modal-"+tipe+"-konten input[name=id_topik]").length > 0 ? $("#modal-"+tipe+"-konten input[name=id_topik]").val() : 0;
        var id_konten = $("#modal-"+tipe+"-konten input[name=id_konten]").length > 0 ? $("#modal-"+tipe+"-konten input[name=id_konten]").val() : 0;
        var formdata = new FormData();
        formdata.append("datafile", file);
        formdata.append("id_topik", id_topik);
        formdata.append("id_konten", id_konten);
        formdata.append("_token", "{{ csrf_token() }}");
        
        // Proses upload via AJAX disubmit ke Controller
        // Selama proses upload, akan menjalankan progress_handler()
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progress_handler, false);
        ajax.open("POST", "/admin/kelas/upload-file", true);
        ajax.send(formdata);
    }

    function progress_handler(event){
        // Tampilkan loader
        $(".preloader").show();

        // Menghitung prosentase
        var percent = (event.loaded / event.total) * 100;

        // Menampilkan prosentasi
        $(".progress-bar").text(Math.round(percent) + '%').css({
            'width' : Math.round(percent) + '%',
            'color' : '#fff',
            'margin-left' : '0px',
            'margin-right' : '0px',
        }).attr('aria-valuenow', Math.round(percent));

        // jika sudah mencapai 100% akan mengganti warna background menjadi hijau
        if(Math.round(percent) == 100){
            window.location.href = '/admin/kelas/detail/{{ $kelas->id_kelas }}?tab=materi&addkonten=1';
        }
    }

    // Get file extension
    function get_file_extension(filename){
        var split = filename.split(".");
        var extension = split[split.length - 1];
        return extension;
    }

    // Validate video
    function validate_video(filename){
        var ext = get_file_extension(filename);
        var extensions = ['mp4', 'mkv', 'mov', 'avi', '3gp'];
        for(var i in extensions){
            if(ext == extensions[i]) return true;
        }
        return false;
    }

    // Validate file
    function validate_file(filename){
        var ext = get_file_extension(filename);
        var extensions = ['doc', 'docx', 'xls', 'xlsx', 'csv', 'pdf', 'jpg', 'jpeg', 'png', 'svg', 'gif', 'bmp', 'rar', 'zip', 'mp3', 'wav', 'txt'];
        for(var i in extensions){
            if(ext == extensions[i]) return true;
        }
        return false;
    }

    // Function show loader
    function show_loader(loading_text){
        $("#modal-loader .modal-body h5").text(loading_text);
        $("#modal-loader").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    // Daterangepicker
    $("#modal-add-konten input[name=waktu_tugas]").daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        showDropdowns: true,
        startDate: "{{ date('d/m/Y H:i') }}",
        endDate: "{{ date('d/m/Y H:i') }}",
        locale: {
            format: 'DD/MM/YYYY HH:mm'
        }
    });
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
    label {font-weight: bold;}
    .tile-topik {margin-bottom: 1rem; cursor: move; -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);}
    .ui-state-highlight {height: 2rem; margin-bottom: 1rem;}
    .sortable-topik .fa, .nav-link .fa {width: 14px;}
    #editor-1, #editor-2 {height: 300px;}
    .preloader {display: none; position: fixed; height: 100%; width: 100%; top: 0; right: 0; left: 0; bottom: 0; z-index: 9999; background: rgba(0,0,0,.55);}
    .preloader p {position: absolute; margin: auto;}
    .progress-bar {color: #333; margin-left: 5px; margin-right: 5px; font-weight: bold;}

	/* Quill */
    .ql-editor {white-space: normal;}
	.ql-editor h1, .ql-editor h2, .ql-editor h3, .ql-editor h4, .ql-editor h5, .ql-editor h6, .ql-editor p {margin-bottom: 1rem!important;}
	.ql-editor ol li {font-size: 14px!important; color: #74757f!important; padding-left: 5px!important;}
</style>

@endsection