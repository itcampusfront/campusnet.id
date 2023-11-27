<div id="sidebar-container" class="sidebar-expanded vh-100 position-fixed bg-white">
    <div class="profile-info d-flex align-items-center d-lg-block text-left text-lg-center py-3 px-lg-0">
        <img class="pp-dashboard mb-0 mb-lg-3 mr-3 mr-lg-0" src="{{asset('assets/images/user/avatar.webp')}}">
        <div class="mr-auto">
            <h5 class="m-0">{{ Auth::user()->nama_user }}</h5>
            <p class="m-0 small text-muted">{{ Auth::user()->email }}</p>
            <p class="m-0 small text-muted">({{ get_role_name(Auth::user()->role) }})</p>
        </div>
        <button class="btn btn-light d-block d-lg-none" type="button" data-toggle="sidebar-colapse" style="background-color: var(--bs-gray-200); height: fit-content">
            <span id="collapse-icon" class="fa fa-times"></span>
        </button>
    </div>
    <hr>
    <div class="list-group list-group-flush">
        <a class="list-group-item py-3 border-0 {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin">
            <i class="icon-collapse fas fa-tachometer-alt position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Dashboard</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/user') ? 'active' : '' }}" href="/admin/user">
            <i class="icon-collapse fas fa-users position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Pengguna</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/website') ? 'active' : '' }}" href="/admin/website">
            <i class="icon-collapse fas fa-globe-asia position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Website</p>
        </a>

        <div class="{{ is_int(strpos(Request::url(), route('admin.artikel.index'))) ? 'a' : '' }}">
            <a class="list-group-item py-3 border-0 {{ is_int(strpos(Request::url(), route('admin.artikel.index'))) ? 'active' : '' }} d-flex align-items-center" href="#submenu1" data-toggle="collapse" aria-expanded="{{ is_int(strpos(Request::url(), route('admin.artikel.index'))) ? 'true' : 'false' }}">
                <i class="icon-collapse fas fa-newspaper position-absolute py-1"></i>
                <p class="mb-0 menu-collapsed" style="margin-left: 2em">Artikel</p>
                <span class="submenu-icon ml-auto"></span>
            </a>
            <div id='submenu1' class="collapse sidebar-submenu bg-light rounded-2 w-100 {{ is_int(strpos(Request::url(), route('admin.artikel.index'))) ? 'show' : '' }}">
                <a href="{{ route('admin.artikel.index') }}" class="list-group-item list-group-item-action {{ is_int(strpos(Request::url(), route('admin.artikel.index'))) && !is_int(strpos(Request::url(), route('admin.artikel.kategori.index'))) && !is_int(strpos(Request::url(), route('admin.artikel.tag.index'))) && !is_int(strpos(Request::url(), route('admin.artikel.kontributor.index'))) ? 'active' : '' }}">
                    <i class="fas fa-copy mr-2"></i>
                    <span class="menu-collapsed">Data Artikel</span>
                </a>
                <a href="{{ route('admin.artikel.kategori.index') }}" class="list-group-item list-group-item-action {{ is_int(strpos(Request::url(), route('admin.artikel.kategori.index'))) ? 'active' : '' }}">
                    <i class="fas fa-th-large mr-2"></i>
                    <span class="menu-collapsed">Kategori</span>
                </a>
                <a href="{{ route('admin.artikel.tag.index') }}" class="list-group-item list-group-item-action {{ is_int(strpos(Request::url(), route('admin.artikel.tag.index'))) ? 'active' : '' }}">
                    <i class="fas fa-tags mr-2"></i>
                    <span class="menu-collapsed">Tag</span>
                </a>
                <a href="{{ route('admin.artikel.kontributor.index') }}" class="list-group-item list-group-item-action {{ is_int(strpos(Request::url(), route('admin.artikel.kontributor.index'))) ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i>
                    <span class="menu-collapsed">Kontributor</span>
                </a>
            </div>
        </div>

        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/fitur') ? 'active' : '' }}" href="/admin/fitur">
            <i class="icon-collapse fas fa-star position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Fitur</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/testimoni') ? 'active' : '' }}" href="/admin/testimoni">
            <i class="icon-collapse fas fa-quote-left position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Testimoni</p>
        </a>
        <!-- <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/transaksi') ? 'active' : '' }}" href="#"><i class="fas fa-exchange-alt mr-3"></i>Transaksi</a> -->
        <a class="list-group-item py-3 border-0" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
            <i class="icon-collapse fas fa-power-off position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Keluar</p>
        </a>
        <form id="form-logout" method="post" action="{{ Auth::user()->role == role_admin() ? '/admin/logout' : '/member/logout' }}">
            {{ csrf_field() }}
        </form>
    </div>
</div>
