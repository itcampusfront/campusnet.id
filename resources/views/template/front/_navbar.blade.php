<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <!-- sadsad -->
    <div class="container justify-content-start">
        <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand p-0 d-flex align-items-center" href="/#home">
            <h1 style="font-family: 'Dancing Script', cursive;">
                <!-- <span class="color-theme-1">Campus</span><span class="color-theme-2">net</span> -->
                <img width="160" src="{{asset('assets/images/logo/campusnet.webp')}}">
            </h1>
        </a>    
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mt-2 mr-auto mt-sm-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="/#fitur">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="/#testimoni">Testimoni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="/#demo">Demo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="/#artikel">Artikel</a>
                </li>
            </ul>
            @if(Auth::guest())
            <div class="nav-item">
                <a class="nav-link btn btn-theme-2 rounded-3" href="/login">Masuk</a>
            </div>
            @else
            <div class="nav-item dropdown dropdown-user order-lg-0 order-1">
                <a class="nav-link dropdown-toggle px-0 px-lg-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <!-- <img src="{{ Auth::user()->foto != '' ? asset('assets/images/user/'.Auth::user()->foto) : asset('assets/images/default/user.jpg') }}" height="40" class="rounded-circle d-none d-lg-block"> -->
                        <div class="bg-light rounded-1 px-3 py-2"><i class="fas fa-user"></i></div>
                    </div>
                    <div class="media d-flex d-lg-none shadow-sm rounded-2 bg-theme-1 py-2 px-3">
                        <img src="{{ Auth::user()->foto != '' ? asset('assets/images/user/'.Auth::user()->foto) : asset('assets/images/default/user.jpg') }}" height="40" class="rounded-circle mr-3 mt-1">
                        <div class="media-body">
                            <sapan>Hai, <strong>{{ Auth::user()->nama_user }}</strong></sapan>
                            <br>
                            <span class="user-role text-white">({{ get_role_name(Auth::user()->role) }})</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-profile rounded-2 dropdown-menu-right shadow-sm shadow-md-0 border-md border-0" aria-labelledby="navbarDropdown">
                    <h5 class="dropdown-header disabled d-none d-lg-block" href="#">
                        <div class="media">
                            <img src="{{ Auth::user()->foto != '' ? asset('assets/images/user/'.Auth::user()->foto) : asset('assets/images/default/user.jpg') }}" height="40" class="rounded-circle mr-3">
                            <div class="media-body">
                                <sapan>Hai, <strong>{{ Auth::user()->nama_user }}</strong></sapan>
                                <br>
                                <span class="user-role">({{ get_role_name(Auth::user()->role) }})</span>
                            </div>
                        </div>
                    </h5>
                    @if(Auth::user()->role != role_admin())
                    <div class="dropdown-divider d-none d-lg-block"></div>
                    <a class="dropdown-item" href="/member">Dashboard</a>
                    <a class="dropdown-item" href="/member/profil">Profil</a>
                    <a class="dropdown-item" href="/member/website">Website</a>
                    @endif
                    @if(Auth::user()->role != role_member())
                    <a class="dropdown-item" href="/admin">Dashboard</a>
                    <a class="dropdown-item" href="/admin/user">Pengguna</a>
                    <a class="dropdown-item" href="/admin/website">Website</a>
                    <a class="dropdown-item" href="/admin/fitur">Fitur</a>
                    <a class="dropdown-item" href="/admin/testimoni">Testimoni</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Keluar</a>
                    <form id="form-logout" method="post" action="{{ Auth::user()->role == role_admin() ? '/admin/logout' : '/member/logout' }}">
                            {{ csrf_field() }}
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</nav>