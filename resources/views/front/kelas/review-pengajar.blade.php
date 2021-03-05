@extends('template/front/main')

@section('title', $kelas->nama_kelas.' | Penilaian Kelas')

@section('content')

<div class="row mt-4 mb-5">
    <div class="container mb-3">
        <a href="/kelas/{{ $kelas->slug_kelas }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left mr-2"></i>Kembali ke Kelas</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3" id="list-konten">
                @include('front/kelas/_sidebar-activity')
            </div>
            <div class="col-md-8">
                @if(percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) == 100)
                <div class="alert alert-success text-center">Sertifikat kamu sudah keluar. Bisa dilihat <a href="#" target="_blank">disini</a>.</div>
                @endif
                <div class="card">
                    <div class="card-header">Penilaian Pengajar</div>
                    <div class="card-body">
                        @if(Session::get('message'))
                        <div class="alert alert-success text-center">{{ Session::get('message') }}</div>
                        @endif
                        <form method="post" action="/kelas/review-pengajar">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Rating <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="rating" class="form-control {{ $errors->has('rating') ? 'border-danger' : '' }}" {{ check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) > 0 ? 'disabled' : '' }}>
                                        <option value="" disabled selected>--Pilih--</option>
                                        <option value="5" {{ $penilaian ? $penilaian->rating == 5 ? 'selected' : '' : '' }}>5 (Sangat Baik)</option>
                                        <option value="4" {{ $penilaian ? $penilaian->rating == 4 ? 'selected' : '' : '' }}>4 (Baik)</option>
                                        <option value="3" {{ $penilaian ? $penilaian->rating == 3 ? 'selected' : '' : '' }}>3 (Netral)</option>
                                        <option value="2" {{ $penilaian ? $penilaian->rating == 2 ? 'selected' : '' : '' }}>2 (Buruk)</option>
                                        <option value="1" {{ $penilaian ? $penilaian->rating == 1 ? 'selected' : '' : '' }}>1 (Sangat Buruk)</option>
                                    </select>
                                    @if($errors->has('rating'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('rating')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ulasan <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="ulasan" class="form-control {{ $errors->has('ulasan') ? 'border-danger' : '' }}" rows="3" placeholder="Masukkan Ulasan" {{ check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) > 0 ? 'disabled' : '' }}>{{ $penilaian ? $penilaian->review : '' }}</textarea>
                                    @if($errors->has('ulasan'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('ulasan')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary" {{ check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) > 0 ? 'disabled' : '' }}><i class="fa fa-save mr-2"></i>Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-extra')

<script type="text/javascript">
    // Load
    $(window).on("load", function(){
        // disable_list();
    });

    // Function complete task
    function complete_task(){
        var id = 0;
        $.ajax({
            type: "post",
            url: "/kelas/progress",
            data: {_token: "{{ csrf_token() }}", id_konten: id},
            success: function(response){
                var result = JSON.parse(response);
                if(result.message == "Sukses!"){
                    $("a.list-group-item").each(function(key,elem){
                        if($(elem).data("id") == id){
                            // Change icon to check-circle
                            $(elem).find(".icon-status .fa").removeClass().addClass("fa fa-check-circle text-success ml-2");
                            // Change icon to unlock
                            var next = $("a.list-group-item")[(key+1)];
                            $(next).find(".icon-status .fa").removeClass().addClass("fa fa-unlock text-primary ml-2");
                            // Update percentage
                            $("#task-percentage").text(result.percentage);
                            $(".progress-bar").css("width", result.percentage + "%").attr("aria-valuenow", result.percentage);
                            if(result.percentage == 100) $(".progress-bar").removeClass("bg-warning").addClass("bg-success");
                        }
                    });
                    disable_list();
                }
            }
        });
    }

    // Function disable list
    function disable_list(){
        $("a.list-group-item").each(function(key,elem){
            $(elem).find(".icon-status .fa-lock").length == 1 ? $(elem).addClass("disabled") : '';
            $(elem).find(".icon-status .fa-unlock").length == 1 ? $(elem).removeClass("disabled") : '';
        });
    }
</script>

@endsection

@section('css-extra')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style type="text/css">
    .form-group label {font-weight: 500;}
    .ql-editor {white-space: normal;}
    #list-konten .list-group-item .fa {width: 14px;}
    #list-konten .list-group-item:hover {background-color: #efefef; text-decoration: none;}
    #list-konten .list-group-item.active {background-color: #efefef; border: 1px solid rgba(0,0,0,.125); text-decoration: none; border-left: 4px solid #007bff;}
    .progress {height: 1.25rem; font-size: .8rem;}
    .progress-bar-label {position: absolute; width: calc(100% - 30px); height: 1.25rem; line-height: 1.25rem; text-align: center;}
    .card-header {font-weight: 500;}
    #player {width: 100%;}
</style>

@endsection