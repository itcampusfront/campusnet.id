@extends('template/front/main')

@section('title', $kelas->nama_kelas.' | '.$konten->konten['nama'])

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
                    <div class="card-header">{{ $konten->konten['nama'] }}</div>
                    <div class="card-body">
                        @if($konten->jenis_konten == 1)
                        <div class="ql-snow"><div class="ql-editor p-0">{!! html_entity_decode($konten->konten['teks']) !!}</div></div>
                        @elseif($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'file')
                        <div class="text-center">
                            <div class="mb-2">
                                <button class="btn btn-sm btn-primary btn-video-control">Play / Pause</button>
                                <div class="mt-2">
                                    <span id="video-current-time">00:00</span> / <span id="video-duration">00:00</span>
                                </div>
                            </div>
                            <video id="file-video" width="{{ get_video_height($konten->konten['video']) >= get_video_width($konten->konten['video']) ? '360' : '100%' }}">
                                <source src="{{ asset('assets/videos/konten-video/'.$konten->konten['video']) }}" type="video/mp4">
                                Your browser does not support HTML video.
                            </video>
                        </div>
                        @elseif($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'youtube')
                        <div class="text-center">
                            <div class="mb-2">
                                <button class="btn btn-sm btn-primary btn-youtube-control">Play / Pause</button>
                                <div class="mt-2">
                                    <span id="youtube-current-time">00:00</span> / <span id="youtube-duration">00:00</span>
                                </div>
                            </div>
                            </div>
                        <div id="player"></div>
                        @elseif($konten->jenis_konten == 3)
                        <a class="btn-download-file" href="{{ URL::to('/assets/files/konten-file/'.$konten->konten['file']) }}" target="_blank">Download File {{ $konten->konten['nama'] }}</a>
                        @elseif($konten->jenis_konten == 4)
                        <iframe id="frame-kuis" src="{{ $konten->konten['kuis'] }}" width="100%" height="600"></iframe>
                        @elseif($konten->jenis_konten == 5)
                        <div class="form-group">
                            <button class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#modal-tugas" {{ $tugas != null ? 'disabled' : '' }}><i class="fa fa-upload mr-2"></i>Kumpulkan Tugas Disini</button>
                        </div>
                        @if($tugas != null && $tugas->progress == 0)
                        <div class="alert alert-success text-center">Tugas sudah di-submit. Tunggu sampai pengajar mengevaluasi tugas kamu.<br>Di-submit pada: {{ generate_date($tugas->progress_at) }}, pukul {{ date('H:i', strtotime($tugas->progress_at)) }} WIB.</div>
                        @elseif($tugas != null && $tugas->progress == 1)
                        <div class="alert alert-success text-center">Tugas sudah dievaluasi. Nilai kamu adalah <strong>{{ $tugas->progress_keterangan['nilai'] }}</strong>.</div>
                        @endif
                        <div class="form-group">
                            <label>Deskripsi:</label>
                            <p>{!! nl2br($konten->konten['deskripsi']) !!}</p>
                        </div>
                        <div class="form-group">
                            <label>Waktu Pengerjaan:</label>
                            <p>
                                {{ generate_date(generate_date_range('explode', $konten->konten['waktu'])['from']) }}, {{ date('H:i', strtotime(generate_date_range('explode', $konten->konten['waktu'])['from'])) }} WIB
                                <br>
                                sampai
                                <br>
                                {{ generate_date(generate_date_range('explode', $konten->konten['waktu'])['to']) }}, {{ date('H:i', strtotime(generate_date_range('explode', $konten->konten['waktu'])['to'])) }} WIB
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-tugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/kelas/upload-tugas" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_konten" value="{{ $konten->id_konten }}">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label">File Tugas <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="file_tugas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="keterangan" class="form-control {{ $errors->has('keterangan') ? 'border-danger' : '' }}" rows="5"></textarea>
                            @if($errors->has('keterangan'))
                            <div class="small text-danger">{{ ucfirst($errors->first('keterangan')) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" disabled><i class="fa fa-save mr-2"></i>Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                </div>
            </form>
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
        var id = "{{ $konten->id_konten }}";
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

    // Function add prefix
    function add_prefix(string, digit, prefix){
        var add = '';
        if(string.toString().length < digit){
            for(var i=string.toString().length; i<digit; i++){
                add += prefix;
            }
        }
        return add + string;
    }

    // Function generate video time
    function generate_video_time(time){
        var time = Math.round(time);
        if(time < 3600){
            var m = Math.floor(time / 60);
            var s = time % 60;
            return add_prefix(m, 2, "0") + ":" + add_prefix(s, 2, "0");
        }
        else{
            var h = Math.floor(time / 3600);
            var m = Math.floor(time / 60) - (Math.floor(time / 3600) * 60);
            var s = time % 60;
            return add_prefix(h, 2, "0") + ":" + add_prefix(m, 2, "0") + ":" + add_prefix(s, 2, "0");
        }
    }

    // Function disable list
    function disable_list(){
        $("a.list-group-item").each(function(key,elem){
            $(elem).find(".icon-status .fa-lock").length == 1 ? $(elem).addClass("disabled") : '';
            $(elem).find(".icon-status .fa-unlock").length == 1 ? $(elem).removeClass("disabled") : '';
        });
    }
</script>

@if($konten->jenis_konten == 1)
<script type="text/javascript">
    $(window).on("load", function(){
        setTimeout(complete_task, 3000);
    });
</script>
@endif

@if($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'file')
<script type="text/javascript">
    // Video
    var video = $("#file-video").length == 1 ? document.getElementById("file-video") : '';

    // Video duration
    video.onloadedmetadata = function(){
        $("#video-duration").text(generate_video_time(this.duration));
    };

    // Video time update
    video.ontimeupdate = function(){
        $("#video-current-time").text(generate_video_time(this.currentTime));
        if(this.currentTime == this.duration) complete_task();
    };

    // Button video control
    $(document).on("click", ".btn-video-control", function(e){
        e.preventDefault();
        video.paused ? video.play() : video.pause();
    });
</script>
@endif

@if($konten->jenis_konten == 2 && $konten->konten['tipe'] == 'youtube')
<script type="text/javascript">
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";

    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: "{{ generate_youtube_id($konten->konten['video']) }}",
            playerVars: {'rel': 0, 'controls': 0, 'modestbranding': 1},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(){
        $("#youtube-duration").text(generate_video_time(player.getDuration()));
    }

    function onPlayerStateChange(event){
        if(player.getPlayerState() == 1) setInterval(getCurrentTime, 1000);
        if(player.getPlayerState() == 0){
            $("#youtube-current-time").text(generate_video_time(player.getDuration()));
            complete_task();
        }
    }

    function getCurrentTime() {
        if(player.getPlayerState() == 1) $("#youtube-current-time").text(generate_video_time(player.getCurrentTime()));
    }

    // Button youtube control
    $(document).on("click", ".btn-youtube-control", function(e){
        e.preventDefault();
        if(player.getPlayerState() == 1) player.pauseVideo();
        else player.playVideo();
    });
</script>
@endif

@if($konten->jenis_konten == 3)
<script type="text/javascript">
    $(document).on("click", ".btn-download-file", function(){
        setTimeout(complete_task, 3000);
    });
</script>
@endif

@if($konten->jenis_konten == 4)
<script type="text/javascript">
    $("#frame-kuis").on("load", function(){
        var iframe = $(this).contents();

        // Button Submit
        $(iframe).find(".btn-submit").on("click", function(e){
            e.preventDefault();
            var ask = confirm("Anda yakin ingin mengumpulkan jawaban kuis Anda?");
            if(ask){
                // Jawaban
                var jawaban = [];
                $(iframe).find(".tile-question").each(function(key,elem){
                    jawaban.push($(elem).find(".form-choice .radio-disabled"));
                });

                // Array Jawaban
                var array_jawaban = [];
                for(i = 0; i < jawaban.length; i++){
                    array_jawaban[i] = '';
                    for(j = 0; j < jawaban[i].length; j++){
                        if($(jawaban[i][j]).is(":checked")) array_jawaban[i] = j;
                    }
                }

                // AJAX
                $.ajax({
                    type: "post",
                    url: "/quiz/submit",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: "{{ $konten->konten['kuis'] }}",
                        jawaban: JSON.stringify(array_jawaban),
                    },
                    success: function(response){
                        console.log(response);
                        var message = response >= 80 ? "Selamat, Anda berhasil!" : "Sayang sekali, Anda gagal.";
                        $(iframe).find(".quiz-message").text(message);
                        $(iframe).find(".quiz-score").text(response);
                        $(iframe).find(".main-quiz").addClass("d-none");
                        $(iframe).find(".main-score").removeClass("d-none");
                        response >= 80 ? complete_task() : '';
                    }
                })
            }
        });

        // Button Ulangi Kuis
        $(iframe).find(".btn-repeat").on("click", function(e){
            e.preventDefault();
            $(iframe).find(".main-quiz").removeClass("d-none");
            $(iframe).find(".main-score").addClass("d-none");

            // Remove jawaban
            var jawaban = [];
            $(iframe).find(".tile-question").each(function(key,elem){
                jawaban.push($(elem).find(".form-choice .radio-disabled"));
            });
            for(i = 0; i < jawaban.length; i++){
                for(j = 0; j < jawaban[i].length; j++){
                    if($(jawaban[i][j]).is(":checked")) $(jawaban[i][j]).prop("checked", false);
                }
            }
        });
    });
</script>
@endif

@if($konten->jenis_konten == 5)
<script type="text/javascript">
    // Change file
    $(document).on("change", "input[type=file]", function(){
        // ukuran maksimal upload file
        var max = 16;

        // validasi
        if(this.files && this.files[0]) {
            // jika ukuran melebihi batas maksimum
            if(this.files[0].size > (max * 1024 * 1024)){
                alert("Ukuran file maksimal " + max + " MB!");
                $(this).val(null);
            }
            // jika ekstensi tidak diizinkan
            else if(!validate_file(this.files[0].name)){
                alert("Ekstensi file tidak diizinkan!");
                $(this).val(null);
            }
            else{
                $("#modal-tugas").find("button[type=submit]").removeAttr("disabled");
            }
        }
    });

    // Get file extension
    function get_file_extension(filename){
        var split = filename.split(".");
        var extension = split[split.length - 1];
        return extension;
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
</script>
@endif

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