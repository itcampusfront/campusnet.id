<div class="sidebar">
    <div class="profile-info d-flex d-lg-block text-left text-lg-center bg-white shadow-sm rounded-3 py-4 mb-4 px-4 px-lg-0">
        <img class="pp-dashboard mb-0 mb-lg-3 mr-3 mr-lg-0" src="{{asset('assets/images/user/avatar.webp')}}">
        <div>
            <h5 class="m-0">{{ Auth::user()->nama_user }}</h5>
            <p class="m-0 small text-muted">{{ Auth::user()->email }}</p>
            <p class="m-0 small text-muted">({{ get_role_name(Auth::user()->role) }})</p>
        </div>
    </div>
    <div class="list-group list-group-flush bg-white shadow-sm rounded-3">
        <a class="list-group-item py-3 border-0 {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin">
            <i class="fas fa-tachometer-alt position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Dashboard</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/user') ? 'active' : '' }}" href="/admin/user">
            <i class="fas fa-users position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Pengguna</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/website') ? 'active' : '' }}" href="/admin/website">
            <i class="fas fa-globe-asia position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Website</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/fitur') ? 'active' : '' }}" href="/admin/fitur">
            <i class="fas fa-star position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Fitur</p>
        </a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/admin/testimoni') ? 'active' : '' }}" href="/admin/testimoni">
            <i class="fas fa-quote-left position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Testimoni</p>
        </a>
        <!-- <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/transaksi') ? 'active' : '' }}" href="#"><i class="fas fa-exchange-alt mr-3"></i>Transaksi</a> -->
        <a class="list-group-item py-3 bg-transparent border-0" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
            <i class="fas fa-power-off position-absolute py-1"></i>
            <p class="mb-0" style="margin-left: 2em">Keluar</p>
        </a>
        <form id="form-logout" method="post" action="{{ Auth::user()->role == role_admin() ? '/admin/logout' : '/member/logout' }}">
            {{ csrf_field() }}
        </form>
    </div>
</div>