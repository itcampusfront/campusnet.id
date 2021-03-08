
                <div class="sidebar">
                    <div class="profile-info text-center bg-white shadow-sm rounded-3 py-4 mb-4">
                        <img width="100" class="mb-3" src="https://ingeniolms.com/img/avatar.svg">
                        <h5>{{ Auth::user()->nama_user }}</h5>
                        <p>{{ Auth::user()->email }}</p>
                        <p><strong>({{ get_role_name(Auth::user()->role) }})</strong></p>
                    </div>
                    <div class="list-group list-group-flush bg-white shadow-sm rounded-3 p-3">
                        <a class="list-group-item mb-3 border-0 {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a>
                        <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/user') ? 'active' : '' }}" href="/admin/user"><i class="fas fa-users mr-3"></i>User</a>
                        <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/website') ? 'active' : '' }}" href="/admin/website"><i class="fas fa-globe-asia mr-3"></i>Website</a>
                        <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/fitur') ? 'active' : '' }}" href="/admin/fitur"><i class="fas fa-star mr-3"></i>Fitur</a>
                        <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/testimoni') ? 'active' : '' }}" href="/admin/testimoni"><i class="fas fa-quote-left mr-3"></i>Testimoni</a>
                        <!-- <a class="list-group-item mb-3 border-0 {{ strpos(Request::url(), '/admin/transaksi') ? 'active' : '' }}" href="#"><i class="fas fa-exchange-alt mr-3"></i>Transaksi</a> -->
                        <a class="list-group-item border-0" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><i class="fas fa-power-off mr-3"></i>Keluar</a>
                        <form id="form-logout" method="post" action="{{ Auth::user()->role == role_admin() ? '/admin/logout' : '/member/logout' }}">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>