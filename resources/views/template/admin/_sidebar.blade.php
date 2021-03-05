
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar mx-auto" height="100" src="{{ asset('assets/images/logo/'.get_logo()) }}" alt="User Image">
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/user') ? 'active' : '' }}" href="/admin/user"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User</span></a></li>
        @endif
        @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kategori') ? 'active' : '' }}" href="/admin/kategori"><i class="app-menu__icon fa fa-tags"></i><span class="app-menu__label">Kategori</span></a></li>
        @endif
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kelas') ? 'active' : '' }}" href="/admin/kelas"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Kelas</span></a></li>
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kuis') ? 'active' : '' }}" href="/admin/kuis"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Kuis</span></a></li>
      </ul>
    </aside>