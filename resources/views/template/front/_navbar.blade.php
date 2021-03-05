<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <!-- sadsad -->
    <div class="container justify-content-between">
        <button class="navbar-toggler mr-0 mr-lg-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand m-0 mr-lg-3 p-0" href="/">
            <h1 class="color-theme-1" style="font-family: 'Dancing Script', cursive;">Campusnet</h1>
        </a>

        <div class="nav-item dropdown megamenu-li dropdown-user d-lg-none">
            <a class="nav-link dropdown-toggle px-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell h3 m-0 text-muted"></i>
                <span class="badge rounded-pill bg-theme-1" style="position: relative; top: -1.5em; right: 1em">3</span>
            </a>
            <div class="dropdown-menu shadow-sm border-0 megamenu" aria-labelledby="navbarDropdown">
                <h5 class="dropdown-header font-weight-bold">Pemberitahuan</h5>
                <div class="dropdown-divider"></div>
                <div class="content-penguman">
                    <a class="dropdown-item" href="#">
                        <div class="media">
                            <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                            <div class="media-body" style="white-space: normal;">
                                <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="#">
                        <div class="media">
                            <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                            <div class="media-body" style="white-space: normal;">
                                <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                    </a>
                    <a class="dropdown-item" href="#">
                        <div class="media">
                            <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                            <div class="media-body" style="white-space: normal;">
                                <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" href="#">Lihat Semua</a>
            </div>
        </div>    
                    
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <form class="mx-2 my-auto d-inline w-100">
                <div class="input-group">
                    <input type="text" class="form-control border border-right-0" placeholder="Search..." style="border-radius: 1.5em 0 0 1.5em">
                    <span class="input-group-append">
                        <button class="btn btn-outline border border-left-0" type="button" style="border-radius: 0 1.5em 1.5em 0">
                            <i class="fa fa-search color-theme-1"></i>
                        </button>
                    </span>
                </div>
            </form>
            <div class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user h5 m-0"></i>
                </a>
                <div class="dropdown-menu rounded-2 dropdown-menu-right shadow-sm border-0" aria-labelledby="navbarDropdown">
                    <h5 class="dropdown-header disabled" href="#">
                    </h5>
                    <div class="dropdown-divider"></div>
                    @if(Auth::user()->role != role_pelajar())
                    <a class="dropdown-item" href="/admin" target="_blank">Dashboard</a>
                    @endif
                    <a class="dropdown-item" href="/profil">Profil</a>
                    @if(Auth::user()->role == role_pengajar())
                    <a class="dropdown-item" href="/list-kelas">List Kelas</a>
                    @endif
                    @if(Auth::user()->role == role_pelajar())
                    <a class="dropdown-item" href="/riwayat-kelas">Riwayat Kelas</a>
                    @endif
                    <a class="dropdown-item" href="/ganti-password">Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Keluar</a>
                </div>
            </div>
            <ul class="navbar-nav ml-auto mt-2 mt-sm-0 align-items-lg-center">
                <li class="nav-item {{ strpos(Request::url(), '/kategori') ? 'active' : '' }}">
                    <a class="nav-link font-weight-bold" href="/kategori">Kategori</a>
                </li>
                <li class="nav-item {{ strpos(Request::url(), '/kelas') ? 'active' : '' }}">
                    <a class="nav-link font-weight-bold" href="/kelas">Kelas</a>
                </li>
                <li class="nav-item {{ strpos(Request::url(), '/pengajar') ? 'active' : '' }}">
                    <a class="nav-link font-weight-bold" href="/pengajar">Pengajar</a>
                </li>
                <li class="nav-item dropdown dropdown-user d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell h5 m-0"></i>
                        <span class="badge rounded-pill bg-theme-1" style="position: absolute; top: 0em; right: 0px">3</span>
                    </a>
                    <div class="dropdown-menu rounded-2 dropdown-menu-right shadow-sm border-0 dropdow-notif" aria-labelledby="navbarDropdown">
                        <h5 class="dropdown-header font-weight-bold">Pemberitahuan</h5>
                        <div class="dropdown-divider"></div>
                        <div class="content-penguman">
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                    <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                                    <div class="media-body" style="white-space: normal;">
                                        <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                        <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                    <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                                    <div class="media-body" style="white-space: normal;">
                                        <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                        <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                    <i class="fas fa-bell h4 text-muted m-0 mr-3 mt-2"></i>
                                    <div class="media-body" style="white-space: normal;">
                                        <p class="dropdown-header p-0 m-0">Pengumuman</p>
                                        <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="#">Lihat Semua</a>
                    </div>
                </li>
                @if(Auth::guest())
                <a class="btn btn-theme-1 rounded-3 px-3 ml-0 ml-lg-2" href="/login">Masuk</a>
                @else
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user h5 m-0"></i>
                    </a>
                    <div class="dropdown-menu rounded-2 dropdown-menu-right shadow-sm border-0" aria-labelledby="navbarDropdown">
                        <h5 class="dropdown-header disabled" href="#">
                            <div class="media">
                                <img src="{{ Auth::user()->foto != '' ? asset('assets/images/user/'.Auth::user()->foto) : asset('assets/images/default/user.jpg') }}" height="40" class="rounded-circle mr-3">
                                <div class="media-body">
                                    <sapan>Hai, <strong>{{ Auth::user()->nama_user }}</strong></sapan>
                                    <br>
                                    <span class="user-role">({{ get_role_name(Auth::user()->role) }})</span>
                                </div>
                            </div>
                        </h5>
                        <div class="dropdown-divider"></div>
                        @if(Auth::user()->role != role_pelajar())
                        <a class="dropdown-item" href="/admin" target="_blank">Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="/profil">Profil</a>
                        @if(Auth::user()->role == role_pengajar())
                        <a class="dropdown-item" href="/list-kelas">List Kelas</a>
                        @endif
                        @if(Auth::user()->role == role_pelajar())
                        <a class="dropdown-item" href="/riwayat-kelas">Riwayat Kelas</a>
                        @endif
                        <a class="dropdown-item" href="/ganti-password">Ganti Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Keluar</a>
                    </div>
                </li>
                <form id="form-logout" class="d-none" method="post" action="{{ Auth::user()->role != role_pelajar() ? '/admin/logout' : '/logout' }}">{{ csrf_field() }}</form>
                @endif
            </ul>
        </div>
    </div>
</nav>