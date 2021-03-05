
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="#" class="btn-change-photo" title="Ganti Foto Profil">
                                <img class="rounded-circle profile-photo" width="150" src="{{ $user->foto != '' ? asset('assets/images/user/'.$user->foto) : asset('assets/images/default/user.jpg') }}">
                            </a>
                            <input type="file" class="d-none" id="file" accept="image/*">
                            <p class="h6 mt-3 mb-1">{{ $user->nama_user }}</p>
                            <p class="text-muted">({{ get_role_name($user->role) }})</p>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <a href="/profil" class="list-group-item list-group-item-action {{ strpos(Request::url(), '/profil') ? 'active' : '' }}">Profil</a>
                    @if(Auth::user()->role == role_pengajar())
                    <a href="/list-kelas" class="list-group-item list-group-item-action {{ strpos(Request::url(), '/list-kelas') ? 'active' : '' }}">List Kelas</a>
                    @endif
                    @if(Auth::user()->role == role_pelajar())
                    <a href="/riwayat-kelas" class="list-group-item list-group-item-action {{ strpos(Request::url(), '/riwayat-kelas') ? 'active' : '' }}">Riwayat Kelas</a>
                    @endif
                    <a href="/ganti-password" class="list-group-item list-group-item-action {{ strpos(Request::url(), '/ganti-password') ? 'active' : '' }}">Ganti Password</a>
                </div>