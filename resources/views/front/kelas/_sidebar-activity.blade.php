
    <p class="h5">{{ $kelas->nama_kelas }}</p>
    <p>Oleh {{ $kelas->nama_user }}</p>
    <p>
        <div class="progress">
            <div class="progress-bar {{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) < 100 ? 'bg-warning' : 'bg-success' }}" role="progressbar" style="width: {{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}%;" aria-valuenow="{{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}" aria-valuemin="0" aria-valuemax="100"></div>
            <span class="progress-bar-label"><span id="task-percentage">{{ percentage_completed_tasks(Auth::user()->id_user, $kelas->id_kelas) }}</span>% dikerjakan</span>
        </div>
    </p>
    @if(count($topik)>0)
    <div class="list-group">
        @foreach($topik as $key=>$data)
            <div class="list-group-item d-flex justify-content-between align-items-center text-dark font-weight-bold">
            {{ $data->nama_topik }}
            </div>
            @if(count($data->konten)>0)
                @foreach($data->konten as $key2=>$data_konten)
                    @php
                        $disabled = (check_task_progress(Auth::user()->id_user, $data_konten->id_konten) <= 0 && check_task_progress(Auth::user()->id_user, get_konten_before($kelas->id_kelas, $data_konten->id_konten)) <= 0 && $data_konten->id_konten != get_first_konten($kelas->id_kelas)) ? 'disabled' : '';
                    @endphp
                    <a class="list-group-item d-flex justify-content-between align-items-center text-dark {{ isset($konten) ? $data_konten->id_konten == $konten->id_konten ? 'active' : '' : '' }} {{ $disabled }}" data-id="{{ $data_konten->id_konten }}" href="/kelas/{{ $kelas->slug_kelas }}/aktivitas/{{ $data_konten->id_konten }}">
                        <div class="mr-auto">
                            {{ $data_konten->konten['nama'] }}
                            <br>
                            <span class="text-secondary">
                                @if($data_konten->jenis_konten == 1)
                                <i class="fa fa-text-height mr-2"></i> Teks
                                @elseif($data_konten->jenis_konten == 2)
                                <i class="fa fa-video-camera mr-2"></i> Video
                                @if($data_konten->jenis_konten == 2 && $data_konten->konten['tipe'] == 'youtube')
                                    ({{ generate_video_time($data_konten->konten['durasi']) }})
                                @elseif($data_konten->jenis_konten == 2 && $data_konten->konten['tipe'] == 'file')
                                    ({{ generate_video_time(get_video_time($data_konten->konten['video'])) }})
                                @endif
                                @elseif($data_konten->jenis_konten == 3)
                                <i class="fa fa-file-o mr-2"></i> File
                                @elseif($data_konten->jenis_konten == 4)
                                <i class="fa fa-question mr-2"></i> Kuis
                                @elseif($data_konten->jenis_konten == 5)
                                <i class="fa fa-tasks mr-2"></i> Tugas
                                @endif
                            </span>
                        </div>
                        <div class="icon-status">
                            @if($disabled == '' && check_task_progress(Auth::user()->id_user, $data_konten->id_konten) <= 0)
                            <i class="fa fa-unlock text-primary ml-2"></i>
                            @elseif(check_task_progress(Auth::user()->id_user, $data_konten->id_konten) > 0)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                            @else
                            <i class="fa fa-lock ml-2"></i>
                            @endif
                        </div>
                    </a>
                @endforeach
            @endif
        @endforeach
        <div class="list-group-item d-flex justify-content-between align-items-center text-dark font-weight-bold">Penilaian</div>
        <a class="list-group-item d-flex justify-content-between align-items-center text-dark {{ strpos(Request::url(), '/aktivitas/penilaian/kelas') ? 'active' : '' }} {{ check_task_progress(Auth::user()->id_user, get_last_konten($kelas->id_kelas)) <= 0 && check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0 ? 'disabled' : '' }}" data-id="penilaian-kelas" href="/kelas/{{ $kelas->slug_kelas }}/aktivitas/penilaian/kelas">
            <div class="mr-auto">Penilaian Kelas</div>
            <div class="icon-status">
                @if(check_task_progress(Auth::user()->id_user, get_last_konten($kelas->id_kelas)) <= 0 && check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0)
                <i class="fa fa-lock ml-2"></i>
                @elseif(check_task_progress(Auth::user()->id_user, get_last_konten($kelas->id_kelas)) > 0 && check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0)
                <i class="fa fa-unlock text-primary ml-2"></i>
                @elseif(check_task_progress(Auth::user()->id_user, get_last_konten($kelas->id_kelas)) > 0 && check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) > 0)
                <i class="fa fa-check-circle text-success ml-2"></i>
                @endif
            </div>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center text-dark {{ strpos(Request::url(), '/aktivitas/penilaian/pengajar') ? 'active' : '' }} {{ check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0 && check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) <= 0 ? 'disabled' : '' }}" data-id="penilaian-pengajar" href="/kelas/{{ $kelas->slug_kelas }}/aktivitas/penilaian/pengajar">
            <div class="mr-auto">Penilaian Pengajar</div>
            <div class="icon-status">
                @if(check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0 && check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) <= 0)
                <i class="fa fa-lock ml-2"></i>
                @elseif(check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) > 0 && check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) <= 0)
                <i class="fa fa-unlock text-primary ml-2"></i>
                @elseif(check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) > 0 && check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) > 0)
                <i class="fa fa-check-circle text-success ml-2"></i>
                @endif
            </div>
        </a>
    </div>
    @endif