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
        <a class="list-group-item py-3 border-0 {{ Request::path() == 'member' ? 'active' : '' }}" href="/member"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a>
        @if(Auth::user()->status == 1 && Auth::user()->email_verified == 1)
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/member/profil') ? 'active' : '' }}" href="/member/profil"><i class="fas fa-user mr-3"></i>Profil</a>
        <a class="list-group-item py-3 border-0 {{ strpos(Request::url(), '/member/website') ? 'active' : '' }}" href="/member/website"><i class="fas fa-globe-asia mr-3"></i>Website</a>
        <!-- <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/member/transaksi') ? 'active' : '' }}" href="/member/transaksi"><i class="fas fa-exchange-alt mr-3"></i>Transaksi</a> -->
        @endif
        <a class="list-group-item py-3 border-0 bg-transparent" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><i class="fas fa-power-off mr-3"></i>Keluar</a>
        <form id="form-logout" method="post" action="{{ Auth::user()->role == role_admin() ? '/admin/logout' : '/member/logout' }}">
            {{ csrf_field() }}
        </form>
    </div>
</div>